<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter, useRoute } from "vue-router";
import useProducts from "@/composable/products";
const {productDetails, getProduct, isLoading, errorMessage} = useProducts();

const router = useRouter();
const route = useRoute();
// const baseUrl = "https://inventory_managment_app.test/api/admin";
const id = route.params.id;
// const errorMessage = ref(null);
// const details = ref({});
// const loading = ref(false);
// const productDetails = () => {
//   loading.value = true;
//   axios
//     .get(baseUrl + `/products/${id}`)
//     .then((res) => {
//       if (res.data.status == 200) {
//         details.value = res.data.data;
//       } else {
//         errorMessage.value = "there is an error occured";
//       }
//     })
//     .catch((err) => {
//       errorMessage.value = "there is an error occured";
//     })
//     .finally(() => {
//       loading.value = false;
//     });
// };

onMounted(() => {
  getProduct(id);
});
</script>
<template>
  <div>
    <div class="page-header">
      <div class="page-title">
        <h4>Product Details</h4>
        <h6>Full details of a product</h6>
      </div>
    </div>
    <div
      v-if="isLoading"
      class="d-flex align-items-center justify-content-between"
    >
      <strong>Loading...</strong>
      <div class="spinner-border" role="status" aria-hidden="true"></div>
    </div>
    <div v-else class="row">
      <div class="alert alert-danger" v-if="errorMessage">
        {{ errorMessage }}
      </div>
      <div class="col-lg-8 col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="bar-code-view">
              <img src="/img/barcode1.png" alt="barcode" />
              <a class="printimg">
                <img src="/img/icons/printer.svg" alt="print" />
              </a>
            </div>
            <div class="productdetails">
              <ul class="product-bar">
                <li>
                  <h4>Product</h4>
                  <h6>{{ productDetails.name }}</h6>
                </li>
                <li>
                  <h4>Category</h4>
                  <h6 v-for="category in productDetails.categories" :key="category.id">
                    {{ category.name }}
                  </h6>
                </li>
                <li>
                  <h4>Brand</h4>
                  <h6>{{ productDetails.brand }}</h6>
                </li>
                <!-- <li>
                  <h4>Unit</h4>
                  <h6>{{ details. }}</h6>
                </li> -->
                <li>
                  <h4>SKU</h4>
                  <h6>{{ productDetails.sku }}</h6>
                </li>
                <!-- <li>
                  <h4>Minimum Qty</h4>
                  <h6>{{ details. }}</h6>
                </li> -->
                <li>
                  <h4>Quantity</h4>
                  <h6>{{ productDetails.quantity }}</h6>
                </li>
                <li>
                  <h4>Tax</h4>
                  <h6>{{ productDetails.tax ? productDetails.tax.amount : 0 }} %</h6>
                </li>
                <li>
                  <h4>Taxed Price</h4>
                  <h6>
                    {{ productDetails.taxed_price ? productDetails.taxed_price.amount : 0 }}
                  </h6>
                </li>
                <li>
                  <h4>Price</h4>
                  <h6>
                    {{
                      productDetails.regular_price ? productDetails.regular_price.amount : 0
                    }}
                  </h6>
                </li>
                <li>
                  <h4>Status</h4>
                  <h6>{{ productDetails.status }}</h6>
                </li>
                <li>
                  <h4>Description</h4>
                  <h6>
                    {{ productDetails.description }}
                  </h6>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12">
        <div class="card">
          <div class="card-body">
            <img :src="productDetails.main_image" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>