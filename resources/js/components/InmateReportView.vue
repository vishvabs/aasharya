<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Inmates Report View</h3>

          
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
        props:["id", "fromDate","toDate"],
        data () {
            return {
                inmateId : this.$route.params.id,
                inmateFrom : this.$route.params.fromDate,
                inmateTo : this.$route.params.toDate,
                inmates : {},
             
                }
        },

         methods: {

            loadInmates(){

            //  if(this.$gate.isAdmin()){
            
               axios.get("api/filterinmate/"+this.inmateId+"/"+this.inmateFrom+"/"+this.inmateTo).then(({ data }) => {
                
                this.inmates = data;

              });
            //  }
          },
         },
        mounted() {
            console.log('Component mounted.')
          console.log(this.$userId)

          if(this.$route.params.id === null || this.$route.params.id === undefined){
            this.$router.push({path:'/InmateReport'}); 
          }

            let yourScript1= document.createElement('script')
            yourScript1.setAttribute('src', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')
            document.head.appendChild(yourScript1)

            let yourScript2= document.createElement('script')
            yourScript2.setAttribute('src', 'https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js')
            document.head.appendChild(yourScript2)

             let yourScript3= document.createElement('script')
            yourScript3.setAttribute('src', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js')
            document.head.appendChild(yourScript3)

            let yourScript4= document.createElement('script')
            yourScript4.setAttribute('src', 'https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js')
            document.head.appendChild(yourScript4)

            let yourScript5= document.createElement('script')
            yourScript5.setAttribute('src', 'https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js')
            document.head.appendChild(yourScript5)
          
          
          

        },

        created() {
            this.$Progress.start();
            this.loadInmates();
            
            this.$Progress.finish();
        },

        updated(){
        //  $('#suhTable').DataTable();

           $('#suhTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {extend: 'excel', text: 'Export As Excel'}
        ]
    } );
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
