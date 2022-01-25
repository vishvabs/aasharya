<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Attendance List</h3>

             
              </div>
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
                     <th>Is Present</th>
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="inmate in attendance.data" :key="inmate.id">
                    <td>{{inmate.id}}</td>
                     
                      <td>{{inmate.inmate.name}}</td>
                       <td>{{inmate.inmate.gender== 1 ? "Male" : "FeMale"}}</td>
                      <td>{{inmate.inmate.father}}</td>
                      <td>{{inmate.inmate.mother}}</td>
                      <td>{{inmate.inmate.state}}</td>
                       <td>{{inmate.inmate.idistrict}}</td>
                        <td>{{inmate.inmate.city}}</td>
                        <td><input type="checkbox" v-model="inmate.is_present" v-bind:id="inmate.id" disabled></td>
                      
                     </tr>
                      <!-- <td><img v-bind:src="'/' + product.photo" width="100" alt="product"></td> -->
                 
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
                attendance : {},
                form: new Form({

                }),
                }
        },

         methods: {

            loadInmates(){

           
               axios.get("api/getAttendance/"+this.$userId).then(({ data }) => {
                
                this.attendance = data;

              });
             
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
