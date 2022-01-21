<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <form @submit.prevent="createSuh">
                        <div class="card-header">ADD SUH</div>

                        <div class="card-body">
                            
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
                            <label>Id</label>
                            <input v-model="form.genid" type="text" name="genid"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('genid') }">
                            <has-error :form="form" field="genid"></has-error>
                                </div>
                                </div>
                        </div>

                            <div class="row">
                                
                                 <div class="col-4">
                            <div class="form-group">
                            <label>Name of SUH</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                                </div>
                                </div>

                                   <div class="col-4">
                            <div class="form-group">
                            <label>Address</label>
                            <input v-model="form.address" type="text" name="address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                            <has-error :form="form" field="address"></has-error>
                                </div>
                                </div>

                            <div class="col-4">
                             <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" v-model="form.suh_status">
                              <option  id="1" value="1">Functional</option>
                              <option  id="2" value="2">Under Construction</option>
                              <option  id="3" value="3">To be Functional</option>
                              <option  id="4" value="4">Closed</option>
                            </select>
                            <has-error :form="form" field="suh_status"></has-error>
                        </div>
                                </div>
                            
                        </div>


                        <div class="row">
                                
                                 <div class="col-4">
                            <div class="form-group">
                            <label>Username</label>
                            <input v-model="form.username" type="text" name="username"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                            <has-error :form="form" field="username"></has-error>
                                </div>
                                </div>

                                   <div class="col-4">
                            <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="text" name="password"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                                </div>
                                </div>

                                <div class="col-4">
                            <div class="form-group form-check">
                                
                                <input type="checkbox" v-model="form.status" class="form-check-input" id="status" name="status" checked>
                              <label class="form-check-label" for="exampleCheck1">Check me out{{editid}}</label>
                                            </div>
                                </div>
                            
                        </div>
                        </div>
                        <div class="card-footer">
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props:["id"],
          data () {
            return {
                editid: this.$route.params.id,
                suhs : {},
                  form: new Form({
                    id : '',
                    genid : '',
                    name: '',
                    district_id: '',
                    ulb_id:  '',
                    address: '',
                    username: '',
                    password: '',
                    status: '',
                    created_id: this.$userId,
                    suh_status: '',
                    user_id: '',
                }),
                ulbs:[],
                districts:[],
                editSuh:'',
                autocompleteItems: [],
                lastId:'',
                ggh:'',
                }
        },

         methods: {
             
             onChange(event) {
                 if(this.form.district_id && this.form.ulb_id) {
            var dist = this.districts[this.form.district_id].substring(0,2).toUpperCase();
            var ul = this.ulbs[this.form.ulb_id].substring(0,2).toUpperCase();
            this.form.genid = dist + ul + this.addPad(this.lastId, 3);
                 }
             },

             addPad(number, length) {
   
                var str = '' + number;
                 while (str.length < length) {
                  str = '0' + str;
                 }
   
                    return str;

                },

            makeid(length) {
                     var result           = '';
                     var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                     var charactersLength = characters.length;
                         for ( var i = 0; i < length; i++ ) {
                      result += characters.charAt(Math.floor(Math.random() * 
                     charactersLength));
                          }
                         return result;
                        },

            loadDistricts(){

             if(this.$gate.isAdmin()){
              axios.get("api/district/list").then(({ data }) => (this.districts = data.data));
             }
          },
          loadUlbs(){

             if(this.$gate.isAdmin()){
              axios.get("api/ulb/list").then(({ data }) => (this.ulbs = data.data));
             }
          },

          loadEditSuh(id){

             if(this.$gate.isAdmin()){
              axios.get("api/suh/"+ id).then(({ data }) => {
                  this.editSuh = data.data
               this.form.genid = this.editSuh.genid;
                this.form.district_id = this.editSuh.district_id;
              });
             }
          },

          getLastId(){

             if(this.$gate.isAdmin()){
              axios.get("api/suh/lastId").then(({ data }) => (
                  this.lastId = data.data
               
              ));
             }
          },

            createSuh(){
              this.$Progress.start();

               



              this.form.post('api/suh')
              .then((data)=>{
                if(data.data.success){
                 

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  

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
           
         
        },

        created() {
            
             console.log(this.editid);
             this.$Progress.start();
            if(this.editid > 0 || this.editid !== undefined) {
                this.loadDistricts();
            this.loadUlbs();
            this.loadEditSuh(this.editid);
           
            } else {
             this.getLastId();
            this.form.username = this.makeid(6);
            }
            this.$Progress.finish();
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
