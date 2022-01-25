<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <form @submit.prevent="editMode ? updateInmate() : createInamate()">
                        <div v-show="!editMode" class="card-header">ADD INMATE</div>
                         <div v-show="editMode" class="card-header">UPDATE INMATE</div>

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
                            <select class="form-control" v-model="form.suh_id" @change="onChange($event)">
                              <option 
                                  v-for="(suh,index) in suhs" :key="index"
                                  :value="index"
                                  :selected="index == form.suh_id">{{ suh }}</option>
                            </select>
                            <has-error :form="form" field="suh_id"></has-error>
                        </div>
                                </div>

                                <div class="col-3">
                            <div class="form-group">
                            <label>Id</label>
                            <input v-model="form.genid" type="text" name="genid"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('genid') }" disabled>
                            <has-error :form="form" field="genid"></has-error>
                                </div>
                                </div>
                        </div>

                            <div class="row">
                                
                                 <div class="col-3">
                            <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                                </div>
                                </div>

                                   <div class="col-3">
                             <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" v-model="form.gender">
                              <option  id="1" value="1">Male</option>
                              <option  id="0" value="0">FeMale</option>
                            </select>
                            <has-error :form="form" field="gender"></has-error>
                        </div>
                                </div>

                            <div class="col-3">
                             <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" v-model="form.category">
                              <option  id="1" value="1">General</option>
                              <option  id="2" value="2">New</option>
                            </select>
                            <has-error :form="form" field="category"></has-error>
                        </div>
                                </div>

                                <div class="col-3">
                             <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" v-model="form.type">
                              <option  id="1" value="1">Child</option>
                              <option  id="2" value="2">Adult</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                        </div>
                                </div>
                            
                        </div>


                
                        
                        <div class="row">
                                
                                 <div class="col-3">
                            <div class="form-group">
                            <label>Age</label>
                            <input v-model="form.age" type="text" name="age"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('age') }">
                            <has-error :form="form" field="age"></has-error>
                                </div>
                                </div>

                                       <div class="col-3">
                             <div class="form-group">
                            <label>Specially Abeled</label>
                            <select class="form-control" v-model="form.special_abled">
                              <option  id="1" value="1">Yes</option>
                              <option  id="0" value="0">No</option>
                            </select>
                            <has-error :form="form" field="special_abled"></has-error>
                        </div>
                                       </div>

                                <div class="col-3">
                            <div class="form-group">
                            <label>Father Name</label>
                            <input v-model="form.father" type="text" name="father"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('father') }">
                            <has-error :form="form" field="father"></has-error>
                                </div>
                                </div>
                                <div class="col-3">
                            <div class="form-group">
                            <label>Mother Name</label>
                            <input v-model="form.mother" type="text" name="mother"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('mother') }">
                            <has-error :form="form" field="mother"></has-error>
                                </div>
                                </div>
                            
                        </div>
                        

                        <div class="row">
                                
                                 <div class="col-3">
                            <div class="form-group">
                            <label>Address</label>
                            <input v-model="form.address" type="text" name="address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                            <has-error :form="form" field="address"></has-error>
                                </div>
                                </div>


                                 <div class="col-3">
                            <div class="form-group">
                            <label>City</label>
                            <input v-model="form.city" type="text" name="city"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                            <has-error :form="form" field="city"></has-error>
                                </div>
                                </div>

                                <div class="col-3">
                            <div class="form-group">
                            <label>State</label>
                            <input v-model="form.state" type="text" name="state"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('state') }">
                            <has-error :form="form" field="state"></has-error>
                                </div>
                                </div>
                                <div class="col-3">
                            <div class="form-group">
                            <label>District</label>
                            <input v-model="form.idistrict" type="text" name="idistrict"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('idistrict') }">
                            <has-error :form="form" field="idistrict"></has-error>
                                </div>
                                </div>
                            
                        
                        </div>


                        <div class="row">
                                
                                 <div class="col-3">
                            <div class="form-group">
                            <label>Pin Code</label>
                            <input v-model="form.pin" type="text" name="pin"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('pin') }">
                            <has-error :form="form" field="pin"></has-error>
                                </div>
                                </div>

                                       <div class="col-3">
                             <div class="form-group">
                            <label>ID Type</label>
                            <select class="form-control" v-model="form.id_type">
                              <option  id="1" value="1">Aather Card</option>
                              <option  id="2" value="2">NIC</option>
                            </select>
                            <has-error :form="form" field="id_type"></has-error>
                        </div>
                                       </div>

                                <div class="col-3">
                            <div class="form-group">
                            <label>ID Number</label>
                            <input v-model="form.id_no" type="text" name="id_no"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('id_no') }">
                            <has-error :form="form" field="id_no"></has-error>
                                </div>
                                </div>
                                <div class="col-3">
                            <div class="form-group">
                            <label>Birth Mark</label>
                            <input v-model="form.birthmark" type="text" name="birthmark"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('birthmark') }">
                            <has-error :form="form" field="birthmark"></has-error>
                                </div>
                                </div>
                            
                        </div>



                        <div class="row">
                                
                                 <div class="col-3">
                            <div class="form-group">
                            <label>Known Person Name</label>
                            <input v-model="form.know_person" type="text" name="know_person"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('know_person') }">
                            <has-error :form="form" field="know_person"></has-error>
                                </div>
                                </div>

                                <div class="col-3">
                            <div class="form-group">
                            <label>Know Mobile no</label>
                            <input v-model="form.know_mobile" type="text" name="know_mobile"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('know_mobile') }">
                            <has-error :form="form" field="know_mobile"></has-error>
                                </div>
                                </div>

                                       <div class="col-3">
                             <div class="form-group">
                            <label>Vaccinated</label>
                            <select class="form-control" v-model="form.vaccinated">
                              <option  id="1" value="1">Yes</option>
                              <option  id="0" value="0">No</option>
                            </select>
                            <has-error :form="form" field="vaccinated"></has-error>
                        </div>
                                       </div>

                                
                                
                            
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" v-model="form.desc" type="text" name="desc"
                                 :class="{ 'is-invalid': form.errors.has('desc') }"></textarea>
                            <has-error :form="form" field="desc"></has-error>
                                </div>
                            </div>
                            <div class="col-6">
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
                editMode: false,
                editid: this.$route.params.id,
                inmates : {},
                  form: new Form({
                    id : '',
                    genid : '',
                    name: '',
                    district_id: '',
                    ulb_id:  '',
                    address: '',
                    suh_id: '',
                    gender: '',
                    category: '',
                    created_by: this.$userId,
                    updated_id: this.$userId,
                    type: '',
                    age: '',
                    special_abled: '',
                    father: '',
                    mother: '',
                    city: '',
                    state: '',
                    idistrict: '',
                    pin: '',
                    id_type: '',
                    id_no: '',
                    birthmark: '',
                     know_person: '',
                    know_mobile: '',
                     vaccinated: '',
                    desc: '',
                     photo: '',
                   
                }),
                ulbs:[],
                suhs:[],
                districts:[],
                filterdSuh:[],
                editInmate:'',
                autocompleteItems: [],
                lastId:'',
                ggh:'',
                }
        },

         methods: {
             
             onChange(event) {
                 this.loadFilteredSuh(this.form.district_id,this.form.ulb_id);

                 if(this.editMode){
                     var dist = this.districts[this.form.district_id].substring(0,2).toUpperCase();
                    var ul = this.ulbs[this.form.ulb_id].substring(0,2).toUpperCase();
                     this.form.genid = this.form.genid.replace(/^.{4}/g, dist+ul);

                    
                 }
                 else {
                 if(this.form.district_id && this.form.ulb_id) {
            var dist = this.districts[this.form.district_id].substring(0,2).toUpperCase();
            var ul = this.ulbs[this.form.ulb_id].substring(0,2).toUpperCase();
            this.form.genid = dist + ul + this.addPad(this.lastId, 3);

            
                 }
                 }
             },

             loadFilteredSuh(dis, ulb){

           
              axios.get("api/suh/"+dis + "/" + ulb).then(({ data }) => (this.suhs = data.data));
             
             },

             addPad(number, length) {
   
                var str = '' + number;
                 while (str.length < length) {
                  str = '0' + str;
                 }
   
                    return str;

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

          loadEditInmate(id){

             
              axios.get("api/inmate/"+ id).then(({ data }) => {
                  this.editInmate = data.data;
                  var obj = '{'
                        +'"'+data.data.suh_id+'" : "'+data.data.suh.name+'"' +'}';

                  this.suhs =JSON.parse(obj);
                  this.form.fill(this.editInmate);

              });
            
          },

          getLastId(){

            
              axios.get("api/inmate/lastId").then(({ data }) => (
                  this.lastId = data.data
               
              ));
           
          },

            createInamate(){
              this.$Progress.start();
              this.form.post('api/inmate')
              .then((data)=>{
                if(data.data.success){
                 

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                   this.$router.push({path:'/ListInmate'}); 

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

              updateInmate(){
              this.$Progress.start();
              this.form.put('api/inmate/'+ this.form.id)
              .then((data)=>{
                if(data.data.success){
                 

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                   this.$router.push({path:'/ListInmate'}); 

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
           console.log(this.$gate.isAdmin())
         
        },

        created() {
            console.log('user'+this.$userId)
             console.log(this.editid);
             this.$Progress.start();
            if(this.editid > 0 || this.editid !== undefined) {
                this.editMode = true;
               
            this.loadEditInmate(this.editid);

            } else {
             this.getLastId();
            }
             if(this.editMode){
                // this.loadSuhs();
             }
             this.loadDistricts();
            this.loadUlbs();
            
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
