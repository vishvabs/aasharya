<template>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Attendance Report</h3>

             
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-20">

 <form @submit.prevent="btnClicked()">
                  
                        
                    
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
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
    export default {

        data () {
            return {
               
                form: new Form({
                    user_id : this.$user_id,
                    from_date: '',
                    to_date: '',
                }),
               
                filterdSuh:[],
                }
        },

         methods: {         

          btnClicked() {
         //   $('#suhTable').DataTable().destroy();
        //     this.GenerateReport();
        
              if(this.form.from_date == null || this.form.from_date == ''){
                this.form.from_date = 0;
              }

              if(this.form.to_date== null || this.form.to_date == ''){
                this.form.to_date = 0;
              }
              this.$router.push({name:'AttendanceView', params: {id: this.$user_id, fromDate: this.form.from_date, toDate: this.form.to_date}}); 
             
          },


          
            

             
         },
        mounted() {
            console.log('Component mounted.')
          console.log(this.$userId)
        
          

        },

        created() {
            this.$Progress.start();
           
           
            
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
