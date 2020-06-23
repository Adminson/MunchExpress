<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <card-component>
                    <template slot="title">My Menu items</template>
                    <template slot="main">
                        <div class="section">
                            <multiselect
                                v-model="menu"
                                :options="categories"
                            ></multiselect>
                        </div>
                        <MenuGroup :items="currentMenuItems"></MenuGroup>
                    </template>
                </card-component>
            </div>
            <div class="col-md-4">
                <card-component>
                    <template slot="title">Add Menu item</template>
                    <template slot="main">
                        <menu-add-form :categories="categories"></menu-add-form>
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
    props: ["items"],
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
    },
    data() {
        return {
            menu: "",
            categories: []
        };
    },
    computed: {
        currentMenuItems() {
            return this.items[this.menu];
        }
    }
};
</script>
