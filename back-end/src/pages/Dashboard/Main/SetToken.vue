<template>
  <div class="md-layout">
    <div class="md-layout-item md-size-100">
      <md-card>
        <md-card-header class="md-card-header-icon md-card-header-green">
          <div class="card-icon">
            <md-icon>assignment</md-icon>
          </div>
          <h4 class="title">Set Token Price Per Game</h4>
        </md-card-header>
        <md-card-content>
          <div class="text-right">
            <md-button class="md-primary md-dense" @click="onSetToken">
              Set Token
            </md-button>
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
              <md-table-cell md-label="Game" md-sort-by="game">{{item.game}}</md-table-cell>
              <md-table-cell md-label="Level" md-sort-by="level">{{item.level}}</md-table-cell>
              <md-table-cell md-label="Token Price" md-sort-by="price">{{item.price}}</md-table-cell>
              <md-table-cell md-label="Actions">
                <md-button class="md-icon-button md-raised md-round md-info" @click="onEdit(item)" style="margin: .2rem;">
                  <md-icon>edit</md-icon>
                </md-button>
                <md-button class="md-icon-button md-raised md-round md-danger" @click="onDeleteItem(item)" style="margin: .2rem;">
                  <md-icon>delete</md-icon>
                </md-button>
              </md-table-cell>
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




		<!-- Modal -->
		<div class="modal fade text-left" id="tokenSetForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel33">Set Token</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="#">
						<div class="modal-body">						
						
						   <label>Select Game: </label>
							<div class="form-group">						
								<select class="select2 form-control" multiple="multiple" ref="selectgame" id="selectgame" name="selectgame">
									<option value ="Spider Solitaire">Spider Solitaire</option>
                  <option value ="Chess">Chess</option>
                  <option value ="Candy Crush">Candy Crush</option>
                  <option value ="Maze">Maze</option>
                  <option value ="Super Mario">Super Mario</option>
                  <option value ="Tetris">Tetris</option>
                  <option value ="Blockis Master">Blockis Master</option>
								</select>                                   
							</div>	
						
						
							<label>Level</label>
							<div class="form-group">
								<input type="number" placeholder="1" class="form-control" ref="level" id="level" name="level">
                <input type="hidden" placeholder="" class="form-control" ref="tokenid" id="tokenid" name="tokenid">
							</div>
							
							
							<label>Token Price (USD): </label>
							<div class="form-group">
								<input type="text" placeholder="0.5" class="form-control" ref="tokenprice" id="tokenprice" name="tokenprice">
							</div>


						</div>
						<div class="modal-footer">
							<button  ref="savetokenconfig" id="savetokenconfig" type="button" class="btn btn-primary"  @click="onAddToken" >Save</button>
						</div>
					</form>
				</div>
			</div>
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

import * as $ from "jquery";


  export default {

    components: {
      "pagination": Pagination
  
    },

    data: () => ({
      table: [],
      footerTable: ["Game", "Level", "Price"],

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
          return axios.post(`${url}/get-fourtune-token`, params, options)
          .then(response => { 
                  this.table = response.data.fourtunetokenprices;
         });    

      },
      onDeleteItem(selectedObject){
        var params = {     
            "tokenid":selectedObject.id
            };
          const options = {
            headers: {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
            }
          };
          return axios.post(`${url}/delete-fourtune-token`, params, options)
          .then(response => { 
                  this.$store.dispatch("alerts/success", "Successfully deleted record!");
                  this.table = response.data.fourtunetokenprices;                 
         }); 


      },
      onEdit(selectedObject){
          this.$refs.selectgame.value = selectedObject.game; 
          this.$refs.level.value = selectedObject.level
          this.$refs.tokenprice.value = selectedObject.price
          this.$refs.tokenid.value = selectedObject.id;
           $('#tokenSetForm').modal('show');           


      },
      onAddToken(){
          var params = {
            "selectgame":this.$refs.selectgame.value,
            "level":this.$refs.level.value,
            "tokenprice":this.$refs.tokenprice.value,
            "tokenid":this.$refs.tokenid.value
            };
          const options = {
            headers: {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
            }
          };
          return axios.post(`${url}/set-fourtune-token`, params, options)
          .then(response => { 
                  this.$store.dispatch("alerts/success", "Successfully added new fortune price!");
                  this.table = response.data.fourtunetokenprices;
                  $('#tokenSetForm').modal('hide');
         }); 
      },
      onSetToken(){
         this.$refs.tokenid.value = 0;
         $('#tokenSetForm').modal('show');
      },
      onProFeature() {
        ///this.$store.dispatch("alerts/error", "To Do")

         // console.log($);

        

      },

      customSort() {
        return false
      }

    }

  }

</script>