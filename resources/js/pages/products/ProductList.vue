<script setup>
import { onMounted} from "vue";
import useProducts from "@/composable/products";
const {products, getProducts, loading, errorMessage} = useProducts();
// const categories = ref({});
// const categoryList = () => {
//   axios.get("https://api.salla.dev/admin/v2/categories", {
//     headers: {
//         Authorization: `Bearer ${accessToken}`,
//       },
//   }).then((res) => {
//     categories.value = res.data.data;
//     console.log(categories.value);
//   })
//   .catch(err => {
//     errorMessage.value = "Sorry, something went wrong";
//     console.log(err.response.data.error);
//   })
// };

onMounted(() => {
  getProducts();
});
</script>
<template>
  <div>
    <div class="page-header">
      <div class="page-title">
        <h4>Product List</h4>
        <h6>Manage your products</h6>
      </div>
      <div class="page-btn">
        <a href="#" class="btn btn-added"
          ><img src="/img/icons/plus.svg" alt="img" class="me-1" />Add New
          Product</a
        >
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <a class="btn btn-filter" id="filter_search">
                <img src="/img/icons/filter.svg" alt="img" />
                <span><img src="/img/icons/closes.svg" alt="img" /></span>
              </a>
            </div>
            <div class="search-input">
              <a class="btn btn-searchset"
                ><img src="/img/icons/search-white.svg" alt="img"
              /></a>
            </div>
          </div>
          <div class="wordset">
            <ul>
              <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"
                  ><img src="/img/icons/pdf.svg" alt="img"
                /></a>
              </li>
              <li>
                <a
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="excel"
                  ><img src="/img/icons/excel.svg" alt="img"
                /></a>
              </li>
              <li>
                <a
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="print"
                  ><img src="/img/icons/printer.svg" alt="img"
                /></a>
              </li>
            </ul>
          </div>
        </div>

        <div class="card mb-0" id="filter_inputs">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="row">
                  <div class="col-lg col-sm-6 col-12">
                    <div class="form-group">
                      <select class="select">
                        <option>Choose Status</option>
                        <option value="hidden">Hidden</option>
                        <option value="sold">Sold</option>
                        <option value="out">Out</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg col-sm-6 col-12">
                    <div class="form-group">
                      <select class="select">
                        <option value="">Choose Category</option>
                        <!-- <option
                          v-for="category in categories"
                          :value="category.name"
                          :key="category.id"
                        >
                          {{ category.name }}
                        </option> -->
                      </select>
                    </div>
                  </div>
                  <div class="col-lg col-sm-6 col-12">
                    <div class="form-group">
                      <select class="select">
                        <option>Price</option>
                        <option>150.00</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-1 col-sm-6 col-12">
                    <div class="form-group">
                      <a class="btn btn-filters ms-auto"
                        ><img src="/img/icons/search-whites.svg" alt="img"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          v-if="loading"
          class="d-flex align-items-center justify-content-between"
        >
          <strong>Loading...</strong>
          <div class="spinner-border" role="status" aria-hidden="true"></div>
        </div>
        <div v-else class="table-responsive">
          <div class="alert alert-danger" v-if="errorMessage">{{ errorMessage }}</div>
          <table class="table">
            <thead>
              <tr>
                <th>
                  <label class="checkboxs">
                    <input type="checkbox" id="select-all" />
                    <span class="checkmarks"></span>
                  </label>
                </th>
                <th>Product Name</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Sale Price</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-if="products.length"
                v-for="product in products"
                :key="product.id"
              >
                <td>
                  <label class="checkboxs">
                    <input type="checkbox" />
                    <span class="checkmarks"></span>
                  </label>
                </td>
                <td class="productimgname">
                  <a href="javascript:void(0);" class="product-img">
                    <img :src="product.main_image" alt="product" />
                  </a>
                  <a href="javascript:void(0);">{{ product.name }}</a>
                </td>
                <td>{{ product.sku }}</td>
                <td
                  v-if="product.categories"
                  v-for="category in product.categories"
                  :key="category.id"
                >
                  {{ category.name }}
                </td>
                <td>{{ product.regular_price.amount }}</td>
                <td>{{ product.sale_price.amount }}</td>
                <td>{{ product.quantity }}</td>
                <td>{{ product.status }}</td>
                <td>
                  <router-link :to="{name: 'product.details', params: {id: product.id}}" class="me-3">
                    <img src="/img/icons/eye.svg" alt="img" />
                  </router-link>
                  <a class="me-3" href="#">
                    <img src="/img/icons/edit.svg" alt="img" />
                  </a>
                  <a class="confirm-text" href="javascript:void(0);">
                    <img src="/img/icons/delete.svg" alt="img" />
                  </a>
                </td>
              </tr>
              <tr v-else>
                <td colspan="9" class="text-center p-5">No Data Found</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>