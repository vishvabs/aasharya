<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Inmates List</h3>

                <div class="card-tools">
                  
                  <button type="button" @click="addNew()" class="btn btn-sm btn-primary" >
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-20">
                <table id="suhTable" class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>District</th>
                      <th>ULB</th>
                      <th>SUH</th>
                      <th>Name</th>
                       <th>Gender</th>
                          <th>Father Name</th>
                      <th>Mother Name</th>
                      <th>State</th>
                       <th>District</th>
                          <th>City</th>
                      <th>Address</th>
                      
                      <th>ID Type</th>
                      <th>ID No</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="inmate in inmates.data" :key="inmate.id">
                      <td>{{inmate.id}}</td>
                      <td>{{inmate.district.name}}</td>
                      <td>{{inmate.ulb.name}}</td>
                      <td>{{inmate.suh.name}}</td>
                      <td>{{inmate.name}}</td>
                       <td>{{inmate.gender== 1 ? "Male" : "FeMale"}}</td>
                      <td>{{inmate.father}}</td>
                      <td>{{inmate.mother}}</td>
                      <td>{{inmate.state}}</td>
                       <td>{{inmate.idistrict}}</td>
                        <td>{{inmate.city}}</td>
                         <td>{{inmate.address}}</td>
                         <td v-if="inmate.id_type === null">
                           
                          </td> 
                         <td v-if="inmate.id_type === 1">
                             Aather Card
                          </td>  
                          <td v-if="inmate.id_type === 2">
                            NIC
                          </td> 
                           <td>{{inmate.id_no}}</td>
                      

                      <!-- <td><img v-bind:src="'/' + product.photo" width="100" alt="product"></td> -->
                      <td>
                        
                        <a href="#"  @click="editModal(inmate)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteInmate(inmate.id)" >
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
                inmates : {},
                form: new Form({

                }),
                }
        },

         methods: {

            loadInmates(){

             if(this.$gate.isAdmin()){
              axios.get("api/inmate").then(({ data }) => {
                
                this.inmates = data.data;

              });
             } else {
               axios.get("api/getinmate/"+this.$userId).then(({ data }) => {
                
                this.inmates = data;

              });
             }
          },

             deleteInmate(id){
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
                              this.form.delete('api/inmate/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Suh record has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadInmates();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

           editModal(inmate){
           this.$router.push({name:'editInmate', params: {id: inmate.id}}); 
          },

          addNew(){
            this.$router.push({path:'/AddInmate'}); 
          },
             
         },
        mounted() {
            console.log('Component mounted.')
          console.log(this.$userId)
          

        },

        created() {
            this.$Progress.start();
            this.loadInmates();
            
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
