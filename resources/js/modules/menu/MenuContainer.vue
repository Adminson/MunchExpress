<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <card-component>
          <template slot="title">My Menu items</template>
          <template slot="main">
            <div class="section">
              <multiselect v-model="menu" :options="categories"></multiselect>
            </div>
            <MenuGroup :items="currentMenuItems"></MenuGroup>
          </template>
        </card-component>
      </div>
      <div class="col-md-4">
        <card-component>
          <template slot="title">Add Menu item</template>
          <template slot="main">
            <menu-add-form
              :categories="categories"
              :resto-id="restoId"
              @newMenuItemAdded="handleNewMenuItem"
            ></menu-add-form>
          </template>
        </card-component>
      </div>
    </div>
  </div>
</template>

<script>
import _ from "lodash";
import Multiselect from "vue-multiselect";
import MenuGroup from "./MenuGroup.vue";
import MenuAddForm from "./MenuAdd.vue";

export default {
  props: ["items", "restoId"],
  components: {
    Multiselect,
    MenuGroup,
    MenuAddForm
  },
  created() {
    _.forEach(this.items, (item, key) => {
      this.categories.push(key);
    });
    this.menu = this.categories[0];
    this.localItems = this.items;
  },
  data() {
    return {
      localItems: "",
      menu: "",
      categories: []
    };
  },
  computed: {
    currentMenuItems() {
      return this.localItems[this.menu];
    }
  },
  methods: {
    handleNewMenuItem(item, category) {
      this.localItems[category].unshift(item);
      console.log(item);
    }
  }
};
</script>
