<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
      <img
        src="img/avatars/6.jpg"
        class="img-avatar"
        alt="admin@bootstrapmaster.com" />
    </template>\
    <template slot="dropdown">
      <h6 tag="div" class="text-center dropdown-header"><strong>Account</strong></h6>
      <div class="dropdown-item"><i class="fa fa-bell-o" /> Updates
        <span class="badge badge-info">{{ itemsCount }}</span>
      </div>
      <div class="dropdown-item"><i class="fa fa-envelope-o" /> Messages
        <span class="badge badge-success">{{ itemsCount }}</span>
      </div>
      <div class="dropdown-item"><i class="fa fa-tasks" /> Tasks
        <span class="badge badge-danger">{{ itemsCount }}</span>
      </div>
      <div class="dropdown-item"><i class="fa fa-comments" /> Comments
        <span class="badge badge-warning">{{ itemsCount }}</span>
      </div>
      <div
        class="text-center dropdown-header">
        <strong>Settings</strong>
      </div>
      <div class="dropdown-item"><i class="fa fa-user" /> Profile</div>
      <div class="dropdown-item"><i class="fa fa-wrench" /> Settings</div>
      <div class="dropdown-item"><i class="fa fa-usd" /> Payments
        <span class="badge badge-secondary">{{ itemsCount }}</span>
      </div>
      <div class="dropdown-item"><i class="fa fa-file" /> Projects
        <span class="badge badge-primary">{{ itemsCount }}</span>
      </div>
      <!-- <b-dropdown-divider /> -->
      <div class="dropdown-item"><i class="fa fa-shield" /> Lock Account</div>
      <div class="dropdown-item" @click="checkLogout()"><i class="fa fa-lock" /> Logout</div>
    </template>
  </AppHeaderDropdown>
</template>

<script>
import { HeaderDropdown as AppHeaderDropdown } from '@coreui/vue'
export default {
  name: 'DefaultHeaderDropdownAccnt',
  components: {
    AppHeaderDropdown
  },
  data: () => {
    return { itemsCount: 42 }
  },
   methods: {
    checkLogout: function() {
        this.$router.replace({ path: "pages/login" });
    }
  }
}
</script>

<style  scoped>
.dropdown-item{
  cursor: pointer;
  border-bottom-style: none;
}
</style>
