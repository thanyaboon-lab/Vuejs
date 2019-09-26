<template>
  <form id="main" v-cloak>
    <h1>Services</h1>
    <ul>
      <li
        v-for="(service,index) in services"
        :key="index"
        @click="toggleActive(service)"
        :class="{ 'active': service.active}"
      >
        {{service.name}}
        <span>{{'$' + (service.price).toFixed(2)}}</span>
      </li>
    </ul>
    <div class="total">
      Total:
      <span>{{isActive}}</span>
    </div>
  </form>
</template>

<script>
import { log } from "util";
import LoginVue from "../pages/Login.vue";
export default {
  name: "OrderForm",
  data() {
    return {
      question: "",
      services: [
        {
          name: "Web Development",
          price: 300,
          active: true
        },
        {
          name: "Design",
          price: 400,
          active: false
        },
        {
          name: "Integration",
          price: 250,
          active: false
        },
        {
          name: "Training",
          price: 220,
          active: false
        }
      ]
    };
  },
  methods: {
    toggleActive(service) {
      service.active = !service.active;
    }
  },
  computed: {
    isActive() {
      let total = 0;
      let totals = "";
      this.services.map(s => {
        if (s.active) {
          total += s.price;
          totals = "$" + total.toFixed(2);
        } else {
          totals = "$" + total.toFixed(2);
        }
      });
      return totals;
    }
  }
};
</script>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Cookie);
[v-cloak] {
  display: none;
}

* {
  margin: 0;
  padding: 0;
}

body {
  font: 15px/1.3 "Open Sans", sans-serif;
  color: #5e5b64;
  text-align: center;
}

a,
a:visited {
  outline: none;
  color: #389dc1;
}

a:hover {
  text-decoration: none;
}

section,
footer,
header,
aside,
nav {
  display: block;
}

/*-------------------------
    The order form
--------------------------*/

form {
  background-color: #61a1bc;
  border-radius: 2px;
  box-shadow: 0 1px 1px #ccc;
  width: 500px;
  padding: 35px 60px;
  margin: 50px auto;
}

form h1 {
  color: #fff;
  font-size: 64px;
  font-family: "Cookie", cursive;
  font-weight: normal;
  line-height: 1;
  text-shadow: 0 3px 0 rgba(0, 0, 0, 0.1);
}

form ul {
  list-style: none;
  color: #fff;
  font-size: 20px;
  font-weight: bold;
  text-align: left;
  margin: 20px 0 15px;
}

form ul li {
  padding: 20px 30px;
  background-color: #e35885;
  margin-bottom: 8px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

form ul li span {
  float: right;
}

form ul li.active {
  background-color: #8ec16d;
}

div.total {
  border-top: 1px solid rgba(255, 255, 255, 0.5);
  padding: 15px 30px;
  font-size: 20px;
  font-weight: bold;
  text-align: left;
  color: #fff;
}

div.total span {
  float: right;
}
</style>