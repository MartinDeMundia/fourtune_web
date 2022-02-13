<template>
  <div class="md-layout">
    <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
      <stats-card header-color="blue">
        <template slot="header">
          <div class="card-icon" style="background: linear-gradient(60deg, #f0cd0d, #a68d0a) !important;">          
              <md-icon  style="background-image: url('/img/coins.png') !important;background-size: contain;" ></md-icon>
          </div>
          <p class="category">Fourtune Coin Value</p>
          <h3 class="title">
            {{fourtunecoinvalue}}
          </h3>
        </template>

        <template slot="footer">
          <div class="stats">
            <md-icon>update</md-icon>
            Just Updated
          </div>
        </template>
      </stats-card>
    </div>
    <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
      <stats-card header-color="rose">
        <template slot="header">
          <div class="card-icon"  style="background: linear-gradient(60deg, #f0cd0d, #a68d0a) !important;"  >
            <md-icon  style="background-image: url('/img/purchased2.png') !important;background-size: contain;" ></md-icon>
          </div>
          <p class="category">Total Fourtune Purchased</p>
          <h3 class="title">
             {{totalfourtunecoinspurchased}}
          </h3>
        </template>

        <template slot="footer">
          <div class="stats">
            <md-icon>money</md-icon>
            Totals of Gamers who purchased tokens
          </div>
        </template>
      </stats-card>
    </div>
    <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
      <stats-card header-color="green">
        <template slot="header">
          <div class="card-icon">
           <md-icon style="background-image: url('/img/earnings.png') !important;background-size: contain;background-repeat: round;"></md-icon>
          </div>
          <p class="category">Total Coins Earned</p>
          <h3 class="title">
            {{totalcoinsearned}}
          </h3>
        </template>

        <template slot="footer">
          <div class="stats">
            <md-icon>date_range</md-icon>
            Last 24 Hours
          </div>
        </template>
      </stats-card>
    </div>
    <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
      <stats-card header-color="warning">
        <template slot="header">
          <div class="card-icon">
            <md-icon style="background-image: url('/img/transfered.png') !important;background-size: contain;" ></md-icon>
          </div>
          <p class="category">Total Fourtune Transfered</p>
          <h3 class="title">
            {{totalcoinsearned}}
          </h3>
        </template>

        <template slot="footer">
          <div class="stats">
            <md-icon class="text-danger">money</md-icon>
            <a href="#token-transfer">Token transfered by Gamers</a>
          </div>
        </template>
      </stats-card>
    </div>
    <div   
      class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33"
    >


      <chart-card v-if="loadChartData"            
        :chart-data="emailsSubscriptionChart.data"
        :chart-options="emailsSubscriptionChart.options"
        :chart-responsive-options="emailsSubscriptionChart.responsiveOptions"
        chart-type="Bar" 
        id="chartId"     
        chart-inside-header
        background-color="rose"
      >
        <md-icon slot="fixed-button">build</md-icon>
        <md-button class="md-simple md-info md-just-icon" slot="first-button">
          <md-icon>refresh</md-icon>
          <md-tooltip md-direction="bottom">Refresh</md-tooltip>
        </md-button>
        <md-button class="md-simple md-just-icon" slot="second-button">
          <md-icon>edit</md-icon>
          <md-tooltip md-direction="bottom">Change Date</md-tooltip>
        </md-button>

        <template slot="content"   >
          <h4 class="title">Fourtune Coin Value</h4>
          <p class="category">
            Check exchange rate of the fourtune coin
          </p>
        </template>

        <template slot="footer">
          <div class="stats" >
            <md-icon>access_time</md-icon>
            updated 1 min ago
          </div>
        </template>
      </chart-card>

     <!--<div  :id="chartId" class="ct-chart"></div>-->

    <!--   
      <chart-card name="coin_value_chart" ref="coin_value_chart"       
        :chart-data="emailsSubscriptionChart.data"
        :chart-options="emailsSubscriptionChart.options"
        :chart-responsive-options="emailsSubscriptionChart.responsiveOptions"
        chart-type="Bar"      
        chart-inside-header
        background-color="rose"
      >
        <md-icon slot="fixed-button">build</md-icon>
        <md-button class="md-simple md-info md-just-icon" slot="first-button">
          <md-icon>refresh</md-icon>
          <md-tooltip md-direction="bottom">Refresh</md-tooltip>
        </md-button>
        <md-button class="md-simple md-just-icon" slot="second-button">
          <md-icon>edit</md-icon>
          <md-tooltip md-direction="bottom">Change Date</md-tooltip>
        </md-button>

        <template slot="content"   >
          <h4 class="title">Fourtune Coin Value</h4>
          <p class="category">
            Check exchange rate of the fourtune coin
          </p>
        </template>

        <template slot="footer">
          <div class="stats" >
            <md-icon>access_time</md-icon>
            updated 1 min ago
          </div>
        </template>
      </chart-card>-->
    </div>
    <div
      class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33"
    >
      <chart-card v-if="loadChartData" 
        :chart-data="dailySalesChart.data"
        :chart-options="dailySalesChart.options"
        chart-type="Line"
        chart-inside-header
        background-color="green"
      >
        <md-button class="md-simple md-info md-just-icon" slot="first-button">
          <md-icon>refresh</md-icon>
          <md-tooltip md-direction="bottom">Refresh</md-tooltip>
        </md-button>
        <md-button class="md-simple md-just-icon" slot="second-button">
          <md-icon>edit</md-icon>
          <md-tooltip md-direction="bottom">Change Date</md-tooltip>
        </md-button>

        <template slot="content">
          <h4 class="title">Weekly Fourtune Coin Purchases</h4>
          <p class="category">
            <span class="text-success"
              ><i class="fas fa-long-arrow-alt-up"></i>
              5%
            </span>
            Track fourtune coin weekly purchase
          </p>
        </template>

        <template slot="footer">
          <div class="stats">
            <md-icon>access_time</md-icon>
            updated 1 minutes ago
          </div>
        </template>
      </chart-card>
    </div>
    <div
      class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33"
    >
      <chart-card v-if="loadChartData"
        :chart-data="dataCompletedTasksChart.data"
        :chart-options="dataCompletedTasksChart.options"
        chart-type="Line"
        chart-inside-header
        background-color="blue"
      >
        <md-button class="md-simple md-info md-just-icon" slot="first-button">
          <md-icon>refresh</md-icon>
          <md-tooltip md-direction="bottom">Refresh</md-tooltip>
        </md-button>
        <md-button class="md-simple md-just-icon" slot="second-button">
          <md-icon>edit</md-icon>
          <md-tooltip md-direction="bottom">Change Date</md-tooltip>
        </md-button>

        <template slot="content">
          <h4 class="title">Fourtune Gamers  Monthly Rewards</h4>
          <p class="category">
            Monthly Earnings
          </p>
        </template>

        <template slot="footer">
          <div class="stats">
            <md-icon>access_time</md-icon>
            updated 1 min ago
          </div>
        </template>
      </chart-card>
    </div>

    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50">
      <md-card>
        <md-card-header class="md-card-header-text md-card-header-warning">
          <div class="card-text">
            <h4 class="title">Most Active Users</h4>
            <p class="category">
              Preview of active Gamers and Traders
            </p>
          </div>
        </md-card-header>
        <md-card-content>
          <md-table v-model="users" table-header-color="orange">
            <md-table-row slot="md-table-row" slot-scope="{ item }">
              <md-table-cell md-label="Gamer Name">{{ item.gamer }}</md-table-cell>
              <md-table-cell md-label="Date Time">{{ item.created_at }}</md-table-cell>
              <md-table-cell md-label="Game">{{ item.game }}</md-table-cell>
              <md-table-cell md-label="Level">{{ item.level }}</md-table-cell>
              <md-table-cell md-label="Earnings">{{ item.coins_earned }}</md-table-cell>
            </md-table-row>
          </md-table>
        </md-card-content>
      </md-card>
    </div>

    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50">










      <!--<nav-tabs-card>
        <template slot="content">
          <span class="md-nav-tabs-title">Tasks</span>
          <md-tabs md-sync-route class="md-rose" md-alignment="left">
            <md-tab id="tab-home" md-label="Bugs" md-icon="bug_report">
              <md-table v-model="firstTabs" @md-selected="onSelect">
                <md-table-row
                    slot="md-table-row"
                    slot-scope="{ item }"
                    md-selectable="multiple"
                    md-auto-select
                >
                  <md-table-cell>{{ item.tab }}</md-table-cell>
                  <md-table-cell>
                    <md-button class="md-just-icon md-simple md-primary">
                      <md-icon>edit</md-icon>
                      <md-tooltip md-direction="top">Edit</md-tooltip>
                    </md-button>
                    <md-button class="md-just-icon md-simple md-danger">
                      <md-icon>close</md-icon>
                      <md-tooltip md-direction="top">Close</md-tooltip>
                    </md-button>
                  </md-table-cell>
                </md-table-row>
              </md-table>
            </md-tab>

            <md-tab id="tab-pages" md-label="Website" md-icon="code">
              <md-table v-model="secondTabs" @md-selected="onSelect">
                <md-table-row
                    slot="md-table-row"
                    slot-scope="{ item }"
                    md-selectable="multiple"
                    md-auto-select
                >
                  <md-table-cell>{{ item.tab }}</md-table-cell>
                  <md-table-cell>
                    <md-button class="md-just-icon md-simple md-primary">
                      <md-icon>edit</md-icon>
                      <md-tooltip md-direction="top">Edit</md-tooltip>
                    </md-button>
                    <md-button class="md-just-icon md-simple md-danger">
                      <md-icon>close</md-icon>
                      <md-tooltip md-direction="top">Close</md-tooltip>
                    </md-button>
                  </md-table-cell>
                </md-table-row>
              </md-table>
            </md-tab>

            <md-tab id="tab-posts" md-label="Server" md-icon="cloud">
              <md-table v-model="thirdTabs" @md-selected="onSelect">
                <md-table-row
                    slot="md-table-row"
                    slot-scope="{ item }"
                    md-selectable="multiple"
                    md-auto-select
                >
                  <md-table-cell>{{ item.tab }}</md-table-cell>
                  <md-table-cell>
                    <md-button class="md-just-icon md-simple md-primary">
                      <md-icon>edit</md-icon>
                      <md-tooltip md-direction="top">Edit</md-tooltip>
                    </md-button>
                    <md-button class="md-just-icon md-simple md-danger">
                      <md-icon>close</md-icon>
                      <md-tooltip md-direction="top">Close</md-tooltip>
                    </md-button>
                  </md-table-cell>
                </md-table-row>
              </md-table>
            </md-tab>

          </md-tabs>
        </template>
      </nav-tabs-card>-->
    </div>

  </div>
</template>

<script>
import axios from 'axios';
const url = process.env.VUE_APP_API_BASE_URL;

import {
  StatsCard,
  ChartCard,
  //NavTabsCard
} from "@/components";

export default {
  components: {
    StatsCard,
    ChartCard//,
    //NavTabsCard
  },

  data() {
    return {
      users:[],
      loadChartData: Boolean,
      chartId: "no-id",    
      product1: process.env.VUE_APP_APP_BASE_URL + "/img/card-2.jpg",
      product2: process.env.VUE_APP_APP_BASE_URL + "/img/card-3.jpg",
      product3: process.env.VUE_APP_APP_BASE_URL + "/img/card-1.jpg",
      seq2: 0,
      fourtunecoinvalue:"$0.50",
      totalfourtunecoinspurchased:0,
      totalcoinsearned:0,
      totalfourtunecoinstransfered:0,
      selected: [],
      firstTabs: [
        { tab: "Sign contract for \"What are conference organizers afraid of?\""},
        { tab: "Lines From Great Russian Literature? Or E-mails From My Boss?" },
        { tab: "Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit" },
        { tab: "Create 4 Invisible User Experiences you Never Knew About" }
      ],
      secondTabs: [
        {
          tab:
            "Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit"
        },
        {
          tab:
            "Sign contract for \"What are conference organizers afraid of?\""
        }
      ],
      thirdTabs: [
        {
          tab:
            "Lines From Great Russian Literature? Or E-mails From My Boss?"
        },
        {
          tab:
            "Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit"
        },
        {
          tab:
            "Sign contract for \"What are conference organizers afraid of?\""
        }
      ],
/*
      users: [
        {
          id: 1,
          name: "Noelia O'Kon",
          salary: "13098.00",
          country: "Niger"
        },
        {
          id: 2,
          name: "Mr. Enid Von PhD",
          salary: "35978.00",
          country: "Curaçao"
        },
        {
          id: 3,
          name: "Colton Koch",
          salary: "26278.00",
          country: "Netherlands"
        },
        {
          id: 4,
          name: "Gregory Vandervort",
          salary: "25537.00",
          country: "South Korea"
        },
      ],*/
      dailySalesChart: {
        /*data: {
          labels: ["M", "T", "W", "T", "F", "S", "S"],
          series: [[12, 17, 7, 17, 23, 18, 38]]
        },*/
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 125, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      dataCompletedTasksChart: {
        /*data: {
          labels: ["12am", "3pm", "6pm", "9pm", "12pm", "3am", "6am", "9am"],
          series: [[230, 750, 450, 300, 280, 240, 200, 190]]
        },*/

        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 120, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      emailsSubscriptionChart: {
        /*data: {
          labels: [
            "Ja",
            "Fe",
            "Ma",
            "Ap",
            "Mai",
            "Ju",
            "Jul",
            "Au",
            "Se",
            "Oc",
            "No",
            "De"
          ],
          series: [[542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]]
        },*/
        options: {
          axisX: {
            showGrid: false
          },
          low: 0,
          high: 125,
          chartPadding: {
            top: 0,
            right: 5,
            bottom: 0,
            left: 0
          }
        },
        responsiveOptions: [
          [
            "screen and (max-width: 640px)",
            {
              seriesBarDistance: 5,
              axisX: {
                labelInterpolationFnc: function(value) {
                  return value[0];
                }
              }
            }
          ]
        ]
      }
    };
  },
  created() {
     this.loadChartData = false;
  },
  mounted() {
      this.getDashBoardData()
    },
  methods: {
    onSelect: function(items) {
      this.selected = items;
    },
    getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    },    
    getDashBoardData() {
          var params = {"id":1};
          const options = {
            headers: {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
            }
          };
          return axios.post(`${url}/dashboard-data`, params, options)
          .then(response => { 

                var mylabels = [];    var myseries = []; 
                  response.data.fourtunecoinvaluegraph.forEach(function (item, index) {  
                    mylabels.push(item["labels"]);
                    myseries.push(item["series"]);
                });

                this.emailsSubscriptionChart.data = {
                          labels: mylabels,
                          series: [myseries],
                };


                var mylabelspurchases = [];    var myseriespurchases = []; 
                  response.data.fourtunepurchasesgraph.forEach(function (item, index) {  
                    mylabelspurchases.push(item["labels"]);
                    myseriespurchases.push(item["series"]);
                });

                this.dailySalesChart.data = {
                          labels: mylabelspurchases,
                          series: [myseriespurchases],
                };



                var mylabelsearnings = [];    var myseriesearnings = []; 
                  response.data.fourtunegamersearningsgraph.forEach(function (item, index) {  
                    mylabelsearnings.push(item["labels"]);
                    myseriesearnings.push(item["series"]);
                });

                this.dataCompletedTasksChart.data = {
                          labels: mylabelsearnings,
                          series: [myseriesearnings],
                };

          this.users = response.data.fourtuneactiveusers;
          //this.fourtunecoinvalue  = "$"+response.data.fourtunecoinvalue;
          this.totalfourtunecoinspurchased = response.data.totalfourtunecoinspurchased;
          this.totalcoinsearned = response.data.totalcoinsearned;
          this.totalfourtunecoinstransfered = response.data.totalfourtunecoinstransfered;

         /*var chartIdQuery = `#${this.chartId}`;
         console.log(chartIdQuery);
         this.$Chartist["Bar"](chartIdQuery,this.emailsSubscriptionChart['data'],this.emailsSubscriptionChart['options']);*/

         this.loadChartData = true;

         });    

      }

  }
};
</script>
