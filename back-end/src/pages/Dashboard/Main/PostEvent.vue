<template>
  <div class="md-layout">



    <form @submit.prevent="updatePostForm">
        <md-card>

        <div class="text-right">
            <md-button class="md-primary md-dense" @click="onAddImages">
              Add More Images
            </md-button>
          </div>

        <md-card-header class="md-card-header-icon">
            <div class="card-icon">
            <md-icon>perm_identity</md-icon>
            </div>
            <h4 class="title">
            New Event
            </h4>
        </md-card-header>

        <md-card-content>

            <div class="md-layout" style="display: inline-flex !important;">
            <label class="md-layout-item md-size-10 md-form-label">
                Event Name
            </label>
            <div class="md-layout-item">
                <md-field class="md-invalid">
                <md-input v-model="event_name" placeholder="Name / Title of the Event" />             
                </md-field>
            </div>
            </div>

            <div class="md-layout" style="display: inline-flex !important;">
            <label class="md-layout-item md-size-10 md-form-label">
                Event Location (Town/City)
            </label>
            <div class="md-layout-item">
                <md-field class="md-invalid">
                <md-input v-model="event_location" placeholder="Venue where the event is taking place" />             
                </md-field>
            </div>
            </div>



            <div class="md-layout" style="display: inline-flex !important;">
            <label class="md-layout-item md-size-10 md-form-label">
                Featured Event Image
            </label>
            <div class="md-layout-item">
                <md-field class="md-invalid">
                <md-file @change="onFileUpload" />             
                </md-field>
            </div>
            </div>


          <div class="md-layout" style="display: inline-flex !important;">
            <label class="md-layout-item md-size-10 md-form-label">
                Event Date
            </label>
            <div class="md-layout-item">            
                <md-datepicker v-model="event_date"  /> 
            </div>
            </div>


            <div class="md-layout" style="display: inline-flex !important;">
            <label class="md-layout-item md-size-10 md-form-label">
                Event Description
            </label>
            <div class="md-layout-item">
                <md-field class="md-invalid">
                <md-textarea v-model="event_description" placeholder="Event details" />              
                </md-field>
            </div>
            </div>


          <div class="md-layout" style="display: inline-flex !important;">
            <label class="md-layout-item md-size-10 md-form-label">
                Fourtune Token
            </label>
            <div class="md-layout-item">
                <md-field class="md-invalid">
                <md-input v-model="price" placeholder="Fourtune Token" />              
                </md-field>
            </div>
          </div>


        </md-card-content>

        <md-card-actions>
            <md-button type="submit" class="md-primary md-dense" style="background:#f01616 !important">
            Save Event Details
            </md-button>
        </md-card-actions>

        </md-card>
  </form>































            <h3>Top Event Listings</h3>
            <br>
            <div class="row"  >
              
			  
			  <div class="col-md-4"  v-for='event_data in events_data' :key='event_data.id'>
                <div class="card card-product">
                  <div class="card-header card-header-image" data-header-animation="true" style="margin:auto;">
                    <a href="#pablo">
                      <img style="width:200px;height:200px;" class="img" :src=event_data.event_featured_image>
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="card-actions text-center">                 
                      <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="View">
                        <i class="material-icons">art_track</i>
                      </button>
                      <button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Edit">
                        <i class="material-icons">edit</i>
                      </button>
                      <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Remove">
                        <i class="material-icons">close</i>
                      </button>
                    </div>
                    <h4 class="card-title">
                      <a href="#pablo">{{ event_data.event_name}}</a>
                    </h4>
                    <div class="card-description" >  
                       <span v-html="event_data.event_description"></span>               
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="price">
                      <h4>Fourtune(s) @ {{ event_data.price }} /=</h4>
                    </div>
                    <div class="stats">
                      <p  class="card-category" v-if="event_data.event_location"><i class="material-icons">place</i>{{ event_data.event_location }}</p>
                    </div>
                  </div>
                </div>
              </div>
			  
			  
            </div>












































		<!-- Modal -->
		<div class="modal fade text-left" id="addimages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel33">More Event Images</h4>
					 	 <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="closeFilesAdd()">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="#">
						<div class="modal-body">	
                <vue-dropzone 
                    ref="myVueDropzone"
                    :options="dropzoneOptions" 
                    :useCustomSlot=true
                    :include-styling="false"
                    v-on:vdropzone-thumbnail="thumbnail" id="customdropzone"
                    @vdropzone-complete="afterComplete"
                    >
                    <div class="dropzone-custom-content">
                        <h3 class="dropzone-custom-title">Drag and drop to upload!</h3>
                        <div class="subtitle">...or click to select a file from your computer</div>
                    </div>
                </vue-dropzone>
						</div>
						<div class="modal-footer">

                <md-button class="md-primary md-dense" style="background: rgb(232, 146, 113) none repeat scroll 0% 0% !important; float:left;padding-left:2%;margin-right: 2%;" v-on:click="clearImages()">
                  Clear Images
               </md-button>

               <md-button class="md-primary md-dense" style="background:#f01616 !important; float:right;" v-on:click="closeFilesAdd()">
                  Close Window
               </md-button>



						</div>
					</form>
				</div>
			</div>
		</div>

















  </div>
</template>

<script>

//import qs from 'qs';
import axios from 'axios';
import Jsona from 'jsona';
//import {ValidationError} from "@/components";
//import formMixin from "@/mixins/form-mixin";

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

const url = process.env.VUE_APP_API_BASE_URL;

import * as $ from "jquery";
const jsona = new Jsona();
export default {

 data() {
      return {
         events_data: [],
         FILE: null,
         event_location:'',
         event_name: '',
         event_date:'',
         event_description:'',
         price:'',
         dropzoneOptions: {
          autoProcessQueue: false,
          previewTemplate: this.template(),
          url: `${url}/upload-event-images`,
         // url : "localhost/mytest",
          thumbnailWidth: 150,
          thumbnailHeight: 150,
          maxFilesize: 50,
          addRemoveLinks: true,
          headers: { 
               'Access-Control-Allow-Headers': '*',
               'Accept': 'multipart/form-data',
               'Content-Type': 'multipart/form-data'
               }
      }
      };
    },

components: {
    vueDropzone: vue2Dropzone
  },

   // components: {ValidationError},
   // mixins: [formMixin],
    created() {
      this.getEventList();
    },

    methods: {
    getEventList() {
          var params = {"id":1};
          const options = {
            headers: {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
            }
          };
          return axios.post(`${url}/get-events`, params, options)
          .then(response => { 
                  console.log(response.data.events_data);
                  this.events_data = response.data.events_data;
         });
      },
    clearImages(){
      this.$refs.myVueDropzone.removeAllFiles();
    },
    closeFilesAdd(file) { 
          $('#addimages').modal('hide');     
      },
    triggerSend(eventId){
       console.log(this.$refs.myVueDropzone.dropzone.files);
        var parameters = {
              "files": this.$refs.myVueDropzone.dropzone.files,
              "id":eventId,
              "url":`${url}`
          }
           const options = {
            headers: {
                'Accept': 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json',
              }
             };
            return axios.post(`${url}/upload-event-images`,parameters, options)
            .then(response => {
                 //console.log(response.data.message);
                 this.$store.dispatch("alerts/success","Successfully uploaded the images!"); 
                 this.$refs.myVueDropzone.removeAllFiles();
                 $('#addimages').modal('hide');               
            //return jsona.deserialize(response.data);
            });
      },
      sendingEvent(file, xhr, formData) { 
        console.log(formData); 
      },

      afterComplete(file) {         
          this.$refs.myVueDropzone.removeAllFiles();
          $('#addimages').modal('hide');
        //console.log(file);
      },

      onFileUpload (event) {
          this.FILE = event.target.files[0]
        },  
        
      onAddImages(){
          //this.$refs.tokenid.value = 0;
         $('#addimages').modal('show');
      },        
      updatePostForm(){ //event_location
          if(this.event_name == ""){
            this.$store.dispatch("alerts/error","Please enter the event title!");
          }else if(this.event_location == ""){
            this.$store.dispatch("alerts/error","Please enter the event venue / location!");
          }else if(!this.FILE){
            this.$store.dispatch("alerts/error","Please add a featured Image!");
          }else if(this.event_date == ""){
            this.$store.dispatch("alerts/error","Please enter the event date!");
          }else if(this.event_description == ""){
            this.$store.dispatch("alerts/error","Please enter the event description!");
          }else if(this.price == ""){
            this.$store.dispatch("alerts/error","Please enter the Fourtune Token for this event!");
          }else{
                const formData = new FormData()
                formData.append('event_name', this.event_name)
                formData.append('event_location', this.event_location)
                formData.append('event_image', this.FILE, this.FILE.name)                
                formData.append('event_date', this.event_date)
                formData.append('url',`${url}`)
                formData.append('event_description', this.event_description)
                formData.append('price', this.price)
                const options = {
                  headers: {
                      'Accept': 'multipart/form-data',
                      'Content-Type': 'multipart/form-data',
                  }
                  };
                  return axios.post(`${url}/add-event`,formData, options)
                  .then(response => {
                      this.triggerSend(response.data.id);               
                      //console.log(response.data.message);
                      this.getEventList();
                      this.$store.dispatch("alerts/success",response.data.message);                      
                  return jsona.deserialize(response.data);
                  });

           }
            
        },

     template: function () {
        return `<div class="dz-preview dz-file-preview">
                <div class="dz-image">
                    <div data-dz-thumbnail-bg></div>
                </div>
                <div class="dz-details">
                    <div class="dz-size"><span data-dz-size></span></div>
                    <div class="dz-filename"><span data-dz-name></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <div class="dz-success-mark"><i class="fa fa-check"></i></div>
                <div class="dz-error-mark"><i class="fa fa-close"></i></div>
            </div>
        `;
      },
      thumbnail: function(file, dataUrl) {
        var j, len, ref, thumbnailElement;
        if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            ref = file.previewElement.querySelectorAll("[data-dz-thumbnail-bg]");
            for (j = 0, len = ref.length; j < len; j++) {
                thumbnailElement = ref[j];
                thumbnailElement.alt = file.name;
                thumbnailElement.style.backgroundImage = 'url("' + dataUrl + '")';
            }
            return setTimeout(((function(_this) {
                return function() {
                    return file.previewElement.classList.add("dz-image-preview");
                };
            })(this)), 1);
        }

      }


    }

  }

</script>