<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">SUH List</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" >
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
                        <a href="#" >
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
           editModal(suh){
           this.$router.push({name:'editme', params: {id: suh.id}}); 
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
