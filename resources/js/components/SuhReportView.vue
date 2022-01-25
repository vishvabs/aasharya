<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">SUH Report View</h3>

          
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
        props:["disid","ulbid","fromDate","toDate"],
        data () {
            return {
                disId : this.$route.params.disid,
                ulbId : this.$route.params.ulbid,
                suhFrom : this.$route.params.fromDate,
                suhTo : this.$route.params.toDate,
                suhs : {},
             
                }
        },

         methods: {

            loadInmates(){

            //  if(this.$gate.isAdmin()){
            
               axios.get("api/filtersuh/"+this.disId+"/"+this.ulbId+"/"+this.suhFrom+"/"+this.suhTo).then(({ data }) => (
                
                this.suhs = data

               ));
            //  }
          },
         },
        mounted() {
            console.log('Component mounted.')
          console.log(this.$userId)

          if(this.$route.params.disid === null || this.$route.params.disid === undefined){
            this.$router.push({path:'/SuhReport'}); 
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
