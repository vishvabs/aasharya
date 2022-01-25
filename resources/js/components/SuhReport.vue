<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">SUH Report</h3>

             
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-20">

 <form @submit.prevent="btnClicked()">
                    <div class="row">
                        <div class="col-4">
                             <div class="form-group">
                            <label>District</label>
                            <select class="form-control" v-model="form.district_id" >
                              <option 
                                  v-for="(district,index) in districts" :key="index"
                                  :value="index"
                                  :selected="index == form.district_id">{{ district }}</option>
                            </select>
                            <has-error :form="form" field="district_id"></has-error>
                        </div>
                        </div>
                         <div class="col-4">
                             <div class="form-group">
                            <label>Ulb</label>
                            <select class="form-control" v-model="form.ulb_id" required>
                              <option 
                                  v-for="(ulb,index) in ulbs" :key="index"
                                  :value="index"
                                  :selected="index == form.ulb_id">{{ ulb }}</option>
                            </select>
                            <has-error :form="form" field="ulb_id"></has-error>
                        </div>
                        </div>
                        
                    </div>

                     <div class="row">
                        <div class="col-3">
                             <div class="form-group">
                            <label>Date From</label>
                            <input v-model="form.from_date" type="date" name="from_date"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('from_date') }">
                            
                                </div>
                        </div>
                         <div class="col-3">
                              <div class="form-group">
                            <label>Date To</label>
                            <input v-model="form.to_date" type="date" name="to_date"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('to_date') }">
                            
                                </div>
                        </div>
                         <div class="col-3">
                              <div class="form-group">
                                   
                                  <button type="submit" style="margin-top:30px" class="btn btn-primary mt-10">Generate Report</button>
                                </div>  
                        </div>
                    </div>

 </form>


                
              </div>
              <!-- /.card-body -->
          
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
</template>

<script>
    export default {

        data () {
            return {
               
                form: new Form({
                     district_id: '',
                    ulb_id:  '',
                   
                    from_date: '',
                    to_date: '',
                }),
                ulbs:[],
              
                districts:[],
                
                }
        },

         methods: {


              loadDistricts(){

            
              axios.get("api/district/list").then(({ data }) => (this.districts = data.data));
             
          },
          loadUlbs(){

            
              axios.get("api/ulb/list").then(({ data }) => (this.ulbs = data.data));
            
          },

          btnClicked() {
            if(this.form.district_id == null || this.form.district_id == ''){
                this.form.district_id = 0;
              }
              if(this.form.ulb_id == null || this.form.ulb_id == ''){
                this.form.ulb_id = 0;
              }
              if(this.form.from_date == null || this.form.from_date == ''){
                this.form.from_date = 0;
              }

              if(this.form.to_date== null || this.form.to_date == ''){
                this.form.to_date = 0;
              }
    
              this.$router.push({name:'suhView', params: {disid: this.form.district_id, ulbid: this.form.ulb_id, fromDate: this.form.from_date, toDate: this.form.to_date}}); 
             
          },

             
         },
        mounted() {
            console.log('Component mounted.')
          console.log(this.$userId)
        
          

        },

        created() {
            this.$Progress.start();
           
            this.loadDistricts();
            this.loadUlbs();
            
            this.$Progress.finish();
        },

        updated(){
         
        },

        filters: {
 truncate: function (text, length, suffix) {
                return text.substring(0, length) + suffix;
            },
        },
        computed: {
 filteredItems() {
            return this.autocompleteItems.filter(i => {
              return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
          },
        }
    }
</script>
