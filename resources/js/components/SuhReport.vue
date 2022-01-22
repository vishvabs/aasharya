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


                    <div class="row">
                        <div class="col-4">
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
                         <div class="col-4">
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
                         <div class="col-4">
                             <div class="form-group">
                            <label>Suh</label>
                            <select class="form-control" v-model="form.suh_id">
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


                <table id="suhTable" class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>District</th>
                      <th>ULB</th>
                      <th>ID</th>
                      <th>Name</th>
                       <th>Address</th>
                          <th>Username</th>
                      <th>password</th>
                      
                      <th>Actions</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="suh in suhs.data" :key="suh.id">
                      <td>{{suh.id}}</td>
                      <td>{{suh.district.name}}</td>
                      <td>{{suh.ulb.name}}</td>
                      <td>{{suh.genid}}</td>
                       <td>{{suh.name}}</td>
                      <td>{{suh.address}}</td>
                      
                      <td>{{suh.username}}</td>
                      <td>{{suh.password}}</td>
                      

                      <!-- <td><img v-bind:src="'/' + product.photo" width="100" alt="product"></td> -->
                      <td>
                        
                        <a href="#"  @click="editModal(suh)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteSuh(suh.id)" >
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
    export default {

        data () {
            return {
                suhs : {},
                form: new Form({
                     district_id: '',
                    ulb_id:  '',
                    suh_id: '',
                    from_date: '',
                    to_date: '',
                }),
                ulbs:[],
                suhs:[],
                districts:[],
                filterdSuh:[],
                }
        },

         methods: {

              onChange(event) {
                 this.loadFilteredSuh(this.form.district_id,this.form.ulb_id);
             },

             loadFilteredSuh(dis, ulb){
              axios.get("api/suh/"+dis + "/" + ulb).then(({ data }) => (this.suhs = data.data));
             
             },

              loadDistricts(){

            
              axios.get("api/district/list").then(({ data }) => (this.districts = data.data));
             
          },
          loadUlbs(){

            
              axios.get("api/ulb/list").then(({ data }) => (this.ulbs = data.data));
            
          },


            loadSuh(){

            // if(this.$gate.isAdmin()){
              axios.get("api/suh").then(({ data }) => {
                
                this.suhs = data.data;

              });
            // }
          },

             deleteSuh(id){
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {

                      // Send request to the server
                        if (result.value) {
                              this.form.delete('api/suh/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Suh record has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadSuh();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

           editModal(suh){
           this.$router.push({name:'editme', params: {id: suh.id}}); 
          },

          addNew(){
            this.$router.push({path:'/AddSuh'}); 
          },
             
         },
        mounted() {
            console.log('Component mounted.')
          console.log(this.$userId)
          

        },

        created() {
            this.$Progress.start();
            this.loadSuh();
            this.loadDistricts();
            this.loadUlbs();
            
            this.$Progress.finish();
        },

        updated(){
          $('#suhTable').DataTable();
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
