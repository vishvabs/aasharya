<template>
    <section class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-12">
                  <div class="card">
                        <form >
                        <div class="card-header">ADD Attendance</div>
                         

                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-3">
                                  <div class="form-group">
                            <label>District</label>
                            <select class="form-control" v-model="form.district_id" @change="onChange($event)">
                              <option 
                                  v-for="(district,index) in districts" :key="index"
                                  :value="index"
                                  :selected="index == form.district_id">{{ district }}</option>
                            </select>
                            <has-error :form="form" field="district_id"></has-error>
                        </div>
                                </div>
                                 <div class="col-3">
                             <div class="form-group">
                            <label>Ulb</label>
                            <select class="form-control" v-model="form.ulb_id" @change="onChange($event)">
                              <option 
                                  v-for="(ulb,index) in ulbs" :key="index"
                                  :value="index"
                                  :selected="index == form.ulb_id">{{ ulb }}</option>
                            </select>
                            <has-error :form="form" field="ulb_id"></has-error>
                        </div>
                                </div>

                                <div class="col-3">
                             <div class="form-group">
                            <label>Suh</label>
                            <select class="form-control" v-model="form.suh_id" @change="onSelectInmate($event)">
                              <option 
                                  v-for="(suh,index) in suhs" :key="index"
                                  :value="index"
                                  :selected="index == form.suh_id">{{ suh }}</option>
                            </select>
                            <has-error :form="form" field="suh_id"></has-error>
                        </div>
                                </div>


                        </div>

                        <div class="row">
                            
                                    <div class="col-3">
                             <div class="form-group">
                            <label>Inmate</label>
                            <select class="form-control" v-model="form.inmate_id" >
                              <option 
                                  v-for="(inmate,index) in inmatesm" :key="index"
                                  :value="index"
                                  :selected="index == form.inmate_id">{{ inmate }}</option>
                            </select>
                            <has-error :form="form" field="inmate_id"></has-error>
                        </div>
                            
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                        
                        <button type="button" class="btn btn-primary" @click="AddtoTable()">Add</button>
                    </div>
                        </form>
                    </div>
              </div>
          </div>
        <div class="row">

          <div class="col-12">
        
            <div class="card">
           
              <!-- /.card-header -->
              <div class="card-body table-responsive p-20">
                <table id="suhTable" class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                     
                      <th>Name</th>
                       <th>Gender</th>
                          <th>Father Name</th>
                      <th>Mother Name</th>
                      <th>State</th>
                       <th>District</th>
                          <th>City</th>
                     <th>Is Present<th/>
                     
                      
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="inmate in selectedInmates" :key="inmate.id">
                      <td>{{inmate.id}}</td>
                     
                      <td>{{inmate.name}}</td>
                       <td>{{inmate.gender== 1 ? "Male" : "FeMale"}}</td>
                      <td>{{inmate.father}}</td>
                      <td>{{inmate.mother}}</td>
                      <td>{{inmate.state}}</td>
                       <td>{{inmate.idistrict}}</td>
                        <td>{{inmate.city}}</td>
                        <td><input type="checkbox" @change="check($event,inmate.id)"></td>
                      

                    
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                        
                        <button type="button" class="btn btn-primary" @click="AddAttendance()">Save</button>
                    </div>
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
                inmates : {},
                form: new Form({
                        id : '',
                    district_id: '',
                    ulb_id:  '',
                    suh_id: '',
                    inmate_id: '',
                    created_by: this.$userId,
                }),
                 ulbs:[],
                suhs:[],
                inmatesm:[],
                districts:[],
                filterdSuh:[],
                selectedInmates:[],
                postAttendance:[],
                autocompleteItems: [],
                }
        },

         methods: {


             check($event, $id){
             //  this.postAttendance[$id].is_present = true;
             var objIndex = this.postAttendance.findIndex((obj => obj.inmate_id == $id));
             this.postAttendance[objIndex].is_present = true;
                 console.log(this.postAttendance[$id]);

                 
             },

             saveData(){
        
             },

              AddtoTable(){
                    axios.get("api/inmate/"+this.form.inmate_id).then(({ data }) => {this.selectedInmates.push(data.data);
                    console.log(this.inmates);

                    this.postAttendance.push({"inmate_id" : this.form.inmate_id, "created_by" : this.$userId, "is_present" : false});
                    });
                    
                },


             onSelectInmate($event){
                 this.loadFilteredInmates(this.form.suh_id);
             },
             
             onChange(event) {
                 this.loadFilteredSuh(this.form.district_id,this.form.ulb_id);
             },

               loadFilteredInmates(suh){

           
              axios.get("api/inmatefilter/"+suh).then(({ data }) => (this.inmatesm = data.data));
             
             },     

             loadFilteredSuh(dis, ulb){

                 if(this.form.district_id !== '' && this.form.ulb_id !== '')
                 {
           
              axios.get("api/suh/"+dis + "/" + ulb).then(({ data }) => (this.suhs = data.data));
             }
             },          

            loadDistricts(){

            
              axios.get("api/district/list").then(({ data }) => (this.districts = data.data));
             
          },
          loadUlbs(){

            
              axios.get("api/ulb/list").then(({ data }) => (this.ulbs = data.data));
            
          },

            loadSuhs(){

             
              axios.get("api/suh/list").then(({ data }) => (this.suhs = data.data));
             
          },



          AddAttendance(){
                      this.$Progress.start();
               axios.post('api/attendance',{
                 data: this.postAttendance
               })
              .then((data)=>{
                if(data.data.success){
                 

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                   this.$router.push({path:'/ListAttendance'}); 
                  

                } else {
                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });

                  this.$Progress.failed();
                }
              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
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
