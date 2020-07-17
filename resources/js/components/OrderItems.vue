<template>
  <tbody>
    <tr v-for="order in orders" :key="order.id">
      <td>{{ order.id }}</td>
      <td>{{ order.amount }}</td>
      <td>{{ order.isComplete ? "Completed" : "Incomplete" }}</td>
      <td>
        Name: {{ order.order_details.customer_name }} <br />
        Phone: {{ order.order_details.customer_phone }} <br />
        Address: {{ order.order_details.customer_address }}
      </td>
      <td>
        <!-- icons taken from https://coolsymbol.com -->
        <button class="btn btn-success mr-3" @click="clickComplete(order)">
          ✔
        </button>
        <button class="btn btn-warning" @click="clickDelete(order)">✘</button>
      </td>
    </tr>
  </tbody>
</template>

<script>
export default {
  props: ["orders"],
  methods: {
    clickComplete(order) {
      this.$emit("onComplete", order);
    },
    clickDelete(order) {
      this.$emit("onDelete", order);
    }
  }
};
</script>
