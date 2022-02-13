<template>
  <div class="md-layout">
    <div class="md-layout-item md-size-100">
      <md-card>
        <md-card-header class="md-card-header-icon md-card-header-green">
          <div class="card-icon">
            <md-icon>assignment</md-icon>
          </div>
          <h4 class="title">View Fourtune Tokens Purchase Records</h4>
        </md-card-header>
        <md-card-content>
          <div class="text-right">
            <!--<md-button class="md-primary md-dense" @click="onProFeature">
              Add User
            </md-button>-->
          </div>
          <md-table
            :value="table"
            :md-sort.sync="sortation.field"
            :md-sort-order.sync="sortation.order"
            :md-sort-fn="customSort"
            class="paginated-table table-striped table-hover"
          >
            <md-table-toolbar>
              <md-field>
                <label>Per page</label>
                <md-select v-model="pagination.perPage" name="pages">
                  <md-option
                    v-for="item in pagination.perPageOptions"
                    :key="item"
                    :label="item"
                    :value="item"
                  >
                    {{ item }}
                  </md-option>
                </md-select>
              </md-field>

            </md-table-toolbar>

            <md-table-row slot="md-table-row" slot-scope="{ item }">
              <md-table-cell md-label="Date" md-sort-by="created_at">{{item.created_at}}</md-table-cell>
              <md-table-cell md-label="Name (Gamer)" md-sort-by="name">{{item.name}}</md-table-cell>
              <md-table-cell md-label="Email" md-sort-by="email">{{item.email}}</md-table-cell>
              <md-table-cell md-label="Phone" md-sort-by="phone">{{item.phone}}</md-table-cell>              
              <md-table-cell md-label="Amount Purchased (USD)" md-sort-by="token_amount">{{item.token_amount}}</md-table-cell>
              <!--<md-table-cell md-label="Actions">
                <md-button class="md-icon-button md-raised md-round md-info" @click="onProFeature" style="margin: .2rem;">
                  <md-icon>edit</md-icon>
                </md-button>
                <md-button class="md-icon-button md-raised md-round md-danger" @click="onProFeature" style="margin: .2rem;">
                  <md-icon>delete</md-icon>
                </md-button>
              </md-table-cell>-->
            </md-table-row>
          </md-table>

          <div class="footer-table md-table">
            <table>
              <tfoot>
              <tr>
                <th v-for="item in footerTable" :key="item.name" class="md-table-head">
                  <div class="md-table-head-container md-ripple md-disabled">
                    <div class="md-table-head-label">
                      {{ item }}
                    </div>
                  </div>
                </th>
              </tr>
              </tfoot>
            </table>
          </div>

        </md-card-content>

        <md-card-actions md-alignment="space-between">
          <div class="">
            <p class="card-category">
              Showing {{ from + 1 }} to {{ to }} of {{ total }} entries
            </p>
          </div>
          <pagination
            class="pagination-no-border pagination-success"
            v-model="pagination.currentPage"
            :per-page="pagination.perPage"
            :total="total"
          />
        </md-card-actions>

      </md-card>
    </div>
  </div>
</template>

<script>

  import qs from 'qs';
  import axios from 'axios';
  import Jsona from 'jsona';

  const url = process.env.VUE_APP_API_BASE_URL;
  const jsona = new Jsona();


  import Pagination from "@/components/Pagination";

 function fetchDBData(params) {
    const options = {
      headers: {
        'Accept': 'application/vnd.api+json',
        'Content-Type': 'application/vnd.api+json',
      }
    };
    return axios.post(`${url}/token-purchases`, params, options)
    .then(response => {  
      return jsona.deserialize(response.data);
    });

      /*const options = {
        headers: {
        'Accept': 'application/vnd.api+json',
        'Content-Type': 'application/vnd.api+json',
        }
      };
      return axios.post(`${url}/token-purchases`, options)
        .then(response => {
          return {
            list: jsona.deserialize(response.data),
            meta: response.data.meta
          };
        });*/
      }


  export default {

    components: {
      "pagination": Pagination
  
    },

    data: () => ({
      table: [],
      footerTable: ["Date", "Name (Gamer)", "Email", "Phone","Amount Purchased (USD)"],

      query: null,

      sortation: {
        field: "created_at",
        order: "asc"
      },

      pagination: {
        perPage: 5,
        currentPage: 1,
        perPageOptions: [5, 10, 25, 50]
      },

      total: 1

    }),

    computed: {

      sort() {
        if (this.sortation.order === "desc") {
          return `-${this.sortation.field}`
        }

        return this.sortation.field;
      },

      from() {
        return this.pagination.perPage * (this.pagination.currentPage - 1);
      },

      to() {
        let highBound = this.from + this.pagination.perPage;
        if (this.total < highBound) {
          highBound = this.total;
        }
        return highBound;
      },

    },

    created() {
      this.getList()
    },

    methods: {      
      getList() {
          var params = {"id":1};
          const options = {
            headers: {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
            }
          };
          return axios.post(`${url}/token-purchases`, params, options)
          .then(response => { 
                  this.table = response.data.tokenpurchases;
         });    

      },

      onProFeature() {
        this.$store.dispatch("alerts/error", "To Do")
      },

      customSort() {
        return false
      }

    }

  }

</script>