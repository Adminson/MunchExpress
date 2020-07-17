<template>
  <table class="table table-hover table-bordered table-striped">
    <thead>
      <tr>
        <th>Order Id</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Customer details</th>
        <th>Actions</th>
      </tr>
    </thead>

    <order-items
      :orders="localOrders.data"
      @onComplete="handleOrderComplete"
      @onDelete="handleDeleteOrder"
    ></order-items>
  </table>
</template>

<script>
import axios from "axios";
import OrderItems from "./../../components/OrderItems";
export default {
  props: ["orders"],
  components: {
    OrderItems
  },
  data() {
    return {
      localOrders: null
    };
  },
  created() {
    this.localOrders = this.orders;
  },
  methods: {
    handleOrderComplete(order) {
      if (!confirm("Are you sure order is complete?")) {
        return;
      }
      const postData = { order_id: order.id };
      axios.post("/api/order/complete", postData).then(response => {
        this.localOrders.data.forEach((order, index) => {
          if (order.id === response.data.id) {
            this.localOrders.data[index].isComplete = 1;
          }
        });
      });
    },
    handleDeleteOrder(order) {
      if (!confirm("Are you sure you want to delete the order?")) {
        return;
      }
      const postData = { order_id: order.id };
      axios.post("/api/order/remove", postData).then(response => {
        this.localOrders.data = this.localOrders.data.filter(localOrder => {
          return localOrder.id !== order.id;
        });
      });
    }
  }
};
</script>
