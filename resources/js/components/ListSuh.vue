<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">SUH List</h3>

                <div class="card-tools">
                  
                  <button type="button" @click="addNew()" class="btn btn-sm btn-primary" >
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-20">
                <table d="suhTablie" class="table table-hover">
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

                }),
                }
        },

         methods: {

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
