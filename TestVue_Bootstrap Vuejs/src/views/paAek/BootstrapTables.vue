<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="card card card-accent-primary" style="width: 100%;">
        <div class="card card-accent-primary">
          <div class="card-header">
            <h5>
              <b>ข้อมูลส่วนตัว</b>
            </h5>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-user"></i>
                    </span>
                  </div>
                  <input
                    class="form-control"
                    id="input1-group1"
                    type="text"
                    name="input1-group1"
                    placeholder="Username"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Username</span>
                  </div>
                  <input class="form-control" id="username3" type="text" name="username3" />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-user"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <input
                    class="form-control"
                    id="input2-group1"
                    type="email"
                    name="input2-group1"
                    placeholder="Email"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-envelope-o"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-euro"></i>
                    </span>
                  </div>
                  <input
                    class="form-control"
                    id="input3-group1"
                    type="text"
                    name="input3-group1"
                    placeholder=".."
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="card card card-accent-primary" style="width: 100%;">
        <div class="card card-accent-primary">
          <div class="card-header">
            <h5>
              <b>ตารางคำนวน</b>
            </h5>
          </div>
          <div class="card-body">
            <div class="col-4 text-right">
              <span>{{txtStatus}}</span>
            </div>
            <div>
              <button type="button" class="btn btn-primary btn-sm" v-on:click="addData()">Add Data</button>
              <input type="text" v-model="txtSearch" />
              <button @click="SearchTable()" style="margin-left:10px;">Search</button>
              <router-link :to="{ name : 'OrderForm'}" tag="button">OrderForm</router-link>
            </div>
            <div id="table-wrapper" class="scroll lg-6">
              <div id="table-scroll">
                <table class="table-responsive-md">
                  <thead class="thead-dark">
                    <tr>
                      <th
                        v-bind:key="index"
                        v-for="(item, index) in fields"
                        scope="col"
                      >{{item.key}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-bind:key="index" v-for="(item, index) in tableRows">
                      <th scope="row">
                        <input
                          type="text"
                          class="text-left"
                          v-bind:value="item.username"
                          placeholder="กรุณากรอกชื่อ"
                        />
                      </th>
                      <td>{{item.registered}}</td>
                      <td>
                        <input
                          type="text"
                          class="text-center"
                          v-model="tableRows[index].min"
                          v-on:keyup="calMin(item,index)"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="text-right"
                          v-model="tableRows[index].rate"
                          v-on:keyup="calMin(item,index)"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="text-right"
                          v-model="tableRows[index].price"
                          disabled
                        />
                      </td>
                      <td>
                        <span v-bind:class="getBadge(item.status)">{{item.status}}</span>
                      </td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-danger"
                          v-on:click="deleteData(index)"
                        >Delete</button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th scope="col">รวม</th>
                      <th scope="col" colspan="6">{{calpriceSumary}}</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer pb-0 pt-3">
            <paginate
              :page-count="pageData.length"
              :page-range="3"
              :margin-pages="2"
              :click-handler="Paginations"
              :prev-text="'Prev'"
              :next-text="'Next'"
              :container-class="'pagination'"
              :page-class="'page-item'"
            ></paginate>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { shuffleArray } from "@/shared/utils";
//import cTable from "./Table.vue";
import { log } from "util";
import axios from "axios";
import Axios from "axios-observable";
export default {
  name: "BootstrapTables",
  // components: { cTable },
  data: () => {
    return {
      fields: [
        { key: "username", label: "User", sortable: true },
        { key: "registered" },
        { key: "จำนวน" },
        { key: "ราคา" },
        { key: "รวม" },
        { key: "status", sortable: true },
        { key: "tools" }
      ],
      tableRows: [],
      priceSumary: 0,
      info: [],
      errored: false,
      txtSearch: "",
      txtStatus: "",
      pageData: [],
      pagenum:1
    };
  },
  methods: {
    getBadge(status) {
      return status === "Active"
        ? "badge badge-success"
        : status === "Inactive"
        ? "badge badge-secondary"
        : status === "Pending"
        ? "badge badge-warning"
        : status === "Banned"
        ? "badge badge-danger"
        : "badge badge-primary";
    },
    onChangePage(pageOfItems) {
      this.tableRows = pageOfItems;
    },
     Paginations: function(pageNum) {
      this.pagenum = pageNum
      let item = []
      if(this.pagenum){
        axios.get('http://localhost:8000/dashboard/v1/getsimpleData').
        then(response => {
          for(var i = 0;i<=this.pagenum-1;i++){
            item.push(response.data.data[i])
          }
          this.tableRows = item
        })
        
      }
    },
    SearchTable() {
      this.txtStatus = "";
      axios
        .get("http://localhost:8000/dashboard/v1/getSearchData", {
          params: {
            txt: this.txtSearch
          }
        })
        .then(data => {
          this.tableRows = data.data.data;
        })
        .catch(error => {
          console.log(error);
          this.errored = true;
        });
    },
    calMin: function(val, index) {
      return (this.tableRows[index].price =
        this.tableRows[index].min * this.tableRows[index].rate);
    },
    addData: function() {
      return this.tableRows.push({
        username: "",
        registered:
          new Date().getFullYear() +
          "/" +
          new Date().getMonth() +
          "/" +
          new Date().getDate(),
        min: 0,
        rate: 0.0,
        price: 0.0,
        status: "Banned"
      });
    },
    deleteData: function(index) {
      this.tableRows.splice(index, 1);
    }
  },
  watch: {
    txtSearch: function() {
      this.txtStatus = "Loading.....";
      this.SearchTable();
    }
  },
  computed: {
    calpriceSumary: function() {
      var sum = this.tableRows.reduce(function(value, data) {
        return value + Number(data.price);
      }, 0);
      return sum;
    },
    pagination () {
      let item = []
      if(this.pagenum){
        for(var i = 0;i<=this.pagenum;i++){
          item.push(this.tableRows[i])
        }
        return this.item
      } else {
        return this.tableRows
      }
    }
  },
  mounted() {
    let item = []
    axios
      .get("http://localhost:8000/dashboard/v1/getsimpleData")
      .then(response => {
        for(var i = 0;i<=this.pagenum-1;i++){
          item.push(response.data.data[i])
          }
        this.tableRows = item
        this.pageData = response.data.data
      })
      .catch(error => {
        console.log(error);
        this.errored = true;
      })
      .finally(() => (this.loading = false));
  }
};
</script>

<style scoped>
#table-scroll {
  overflow: auto;
}
</style>