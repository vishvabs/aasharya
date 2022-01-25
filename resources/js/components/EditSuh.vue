<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <form @submit.prevent="editMode ? updateSuh() : createSuh()">
              <div v-show="!editMode" class="card-header">ADD SUH</div>
              <div v-show="editMode" class="card-header">UPDATE SUH</div>

              <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label>District</label>
                      <select
                        class="form-control"
                        v-model="form.district_id"
                        @change="onChange($event)"
                        disabled
                      >
                        <option
                          v-for="(district, index) in districts"
                          :key="index"
                          :value="index"
                          :selected="index == form.district_id"
                        >
                          {{ district }}
                        </option>
                      </select>
                      <has-error :form="form" field="district_id"></has-error>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Ulb</label>
                      <select
                        class="form-control"
                        v-model="form.ulb_id"
                        @change="onChange($event)"
                        disabled
                      >
                        <option
                          v-for="(ulb, index) in ulbs"
                          :key="index"
                          :value="index"
                          :selected="index == form.ulb_id"
                        >
                          {{ ulb }}
                        </option>
                      </select>
                      <has-error :form="form" field="ulb_id"></has-error>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>Id</label>
                      <input
                        v-model="form.genid"
                        type="text"
                        name="genid"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('genid') }"
                        disabled
                      />
                      <has-error :form="form" field="genid"></has-error>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Name of SUH</label>
                      <input
                        v-model="form.name"
                        type="text"
                        name="name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                        disabled
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label>Address</label>
                      <input
                        v-model="form.address"
                        type="text"
                        name="address"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('address') }"
                        disabled
                      />
                      <has-error :form="form" field="address"></has-error>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>Capasity</label>
                      <input
                        v-model="form.capacity"
                        type="text"
                        name="capacity"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('capacity') }"
                      />
                      <has-error :form="form" field="capacity"></has-error>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Geo Location</label>
                      <input
                        v-model="form.geo"
                        type="text"
                        name="geo"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('geo') }"
                      />
                      <has-error :form="form" field="geo"></has-error>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>CCTV</label>
                      <select class="form-control" v-model="form.is_cctv">
                        <option id="1" value="1">1</option>
                        <option id="2" value="2">2</option>
                        <option id="3" value="3">3</option>
                        <option id="4" value="4">4</option>
                        <option id="5" value="5">5</option>
                        <option id="6" value="6">6</option>
                        <option id="7" value="7">7</option>
                        <option id="8" value="8">8</option>
                        <option id="9" value="9">9</option>
                        <option id="10" value="10">10</option>
                      </select>
                      <has-error :form="form" field="suh_status"></has-error>
                    </div>
                  </div>
                </div>
                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                        <label>Water Purifier</label>
                        <select class="form-control" v-model="form.is_water">
                          <option id="1" value="1">Yes</option>
                          <option id="2" value="0">No</option>
                        </select>
                        <has-error :form="form" field="is_water"></has-error>
                      </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group">
                        <label>ISO Certification</label>
                        <select class="form-control" v-model="form.is_iso">
                          <option id="1" value="1">Yes</option>
                          <option id="2" value="0">No</option>
                        </select>
                        <has-error :form="form" field="is_iso"></has-error>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label>Hygiene</label>
                        <input
                          v-model="form.hygiene"
                          type="text"
                          name="hygiene"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('hygiene') }"
                        />
                        <has-error :form="form" field="hygiene"></has-error>
                      </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group">
                        <label>Food Distribution</label>
                        <select class="form-control" v-model="form.is_food">
                          <option id="1" value="1">Yes</option>
                          <option id="2" value="0">No</option>
                        </select>
                        <has-error :form="form" field="is_food"></has-error>
                      </div>
                    </div>
                  </div>



                   <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                        <label>Vaccinations</label>
                        <select class="form-control" v-model="form.is_vaccination">
                          <option id="1" value="1">Yes</option>
                          <option id="2" value="0">No</option>
                        </select>
                        <has-error :form="form" field="is_vaccination"></has-error>
                      </div>
                    </div>

                    
                    <div class="col-3">
                      <div class="form-group">
                        <label>SMA Name</label>
                        <input
                          v-model="form.sma_name"
                          type="text"
                          name="sma_name"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('sma_name') }"
                        />
                        <has-error :form="form" field="sma_name"></has-error>
                      </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group">
                        <label>SMA Payment</label>
                       <input
                          v-model="form.sma_payment"
                          type="text"
                          name="sma_payment"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('sma_payment') }"
                        />
                        <has-error :form="form" field="sma_payment"></has-error>
                      </div>
                    </div>

                     <div class="col-3">
                              <div class="form-group">
                            <label>SMA Date</label>
                            <input v-model="form.sma_date" type="date" name="sma_date"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('sma_date') }">
                            
                                </div>
                        </div>
                  </div>


                  <div class="col-3" hidden>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" v-model="form.suh_status">
                        <option id="1" value="1">Functional</option>
                        <option id="2" value="2">Under Construction</option>
                        <option id="3" value="3">To be Functional</option>
                        <option id="4" value="4">Closed</option>
                      </select>
                      <has-error :form="form" field="suh_status"></has-error>
                    </div>
                  </div>
                </div>

                <div class="row" hidden>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Username</label>
                      <input
                        v-model="form.username"
                        type="text"
                        name="username"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('username') }"
                      />
                      <has-error :form="form" field="username"></has-error>
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label>Password</label>
                      <input
                        v-model="form.password"
                        type="text"
                        name="password"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('password') }"
                      />
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group form-check">
                      <input
                        type="checkbox"
                        v-model="form.status"
                        class="form-check-input"
                        id="status"
                        name="status"
                        checked
                      />
                      <label class="form-check-label" for="exampleCheck1"
                        >is Active</label
                      >
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
  props: ["id"],
  data() {
    return {
      editMode: false,
      editid: this.$route.params.id,
      suhs: {},
      form: new Form({
        id: "",
        genid: "",
        name: "",
        district_id: "",
        ulb_id: "",
        address: "",
        username: "",
        password: "",
        status: "",
        created_id: this.$userId,
        updated_id: this.$userId,
        suh_status: "",
        user_id: "",
        capacity: "",
        geo: "",
        is_cctv: "",
        is_water: "",
        is_iso: "",
        hygiene: "",
        is_food: "",
        is_vaccination: "",
        sma_name: "",
        sma_payment: "",
        created_date: "",
        sma_date: "",
      }),
      ulbs: [],
      districts: [],
      editSuh: "",
      autocompleteItems: [],
      lastId: "",
      ggh: "",
    };
  },

  methods: {
    onChange(event) {
      if (this.editMode) {
        var dist = this.districts[this.form.district_id]
          .substring(0, 2)
          .toUpperCase();
        var ul = this.ulbs[this.form.ulb_id].substring(0, 2).toUpperCase();
        this.form.genid = this.form.genid.replace(/^.{4}/g, dist + ul);
      } else {
        if (this.form.district_id && this.form.ulb_id) {
          var dist = this.districts[this.form.district_id]
            .substring(0, 2)
            .toUpperCase();
          var ul = this.ulbs[this.form.ulb_id].substring(0, 2).toUpperCase();
          this.form.genid = dist + ul + this.addPad(this.lastId, 3);
        }
      }
    },

    addPad(number, length) {
      var str = "" + number;
      while (str.length < length) {
        str = "0" + str;
      }

      return str;
    },

    makeid(length) {
      var result = "";
      var characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      var charactersLength = characters.length;
      for (var i = 0; i < length; i++) {
        result += characters.charAt(
          Math.floor(Math.random() * charactersLength)
        );
      }
      return result;
    },

    loadDistricts() {
      axios
        .get("api/district/list")
        .then(({ data }) => (this.districts = data.data));
    },
    loadUlbs() {
      axios.get("api/ulb/list").then(({ data }) => (this.ulbs = data.data));
    },

    loadEditSuh(id) {
      //  if(this.$gate.isAdmin()){
      axios.get("api/suh/editdata/" + id).then(({ data }) => {
        this.editSuh = data.data;
        this.form.id = this.editSuh.id;
        this.form.genid = this.editSuh.genid;
        this.form.district_id = this.editSuh.district_id;
        this.form.ulb_id = this.editSuh.ulb_id;
        this.form.username = this.editSuh.username;
        this.form.password = this.editSuh.password;
        this.form.name = this.editSuh.name;
        this.form.created_id = this.editSuh.created_id;
        this.form.address = this.editSuh.address;
        this.form.status = this.editSuh.status;
        this.form.suh_status = this.editSuh.suh_status;
        this.form.user_id = this.editSuh.user_id;
        this.form.capacity = this.editSuh.capacity;
        this.form.geo = this.editSuh.geo;
        this.form.is_cctv = this.editSuh.is_cctv;
        this.form.is_water = this.editSuh.is_water;
        this.form.is_iso = this.editSuh.is_iso;
        this.form.hygiene = this.editSuh.hygiene;
        this.form.is_food = this.editSuh.is_food;
        this.form.is_vaccination = this.editSuh.is_vaccination;
        this.form.sma_name = this.editSuh.sma_name;
        this.form.sma_payment = this.editSuh.sma_payment;
        this.form.created_date = this.editSuh.created_date;
        this.form.sma_date = this.editSuh.sma_date;
      });
      //  }
    },

    getLastId() {
      if (this.$gate.isAdmin()) {
        axios
          .get("api/suh/lastId")
          .then(({ data }) => (this.lastId = data.data));
      }
    },

    createSuh() {
      this.$Progress.start();
      this.form
        .post("api/suh")
        .then((data) => {
          if (data.data.success) {
            Toast.fire({
              icon: "success",
              title: data.data.message,
            });
            this.$Progress.finish();
          } else {
            Toast.fire({
              icon: "error",
              title: "Some error occured! Please try again",
            });

            this.$Progress.failed();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Some error occured! Please try again",
          });
        });
    },

    updateSuh() {
      this.$Progress.start();
      this.form
        .put("api/suh/" + this.form.id)
        .then((data) => {
          if (data.data.success) {
            Toast.fire({
              icon: "success",
              title: data.data.message,
            });
            this.$Progress.finish();
          } else {
            Toast.fire({
              icon: "error",
              title: "Some error occured! Please try again",
            });

            this.$Progress.failed();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Some error occured! Please try again",
          });
        });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },

  created() {
    console.log("user", this.$userId);
    this.$Progress.start();
    if (this.$userId > 0 || this.$userId !== undefined) {
      this.editMode = true;

      this.loadEditSuh(this.$userId);
    } else {
      this.getLastId();
      this.form.username = this.makeid(6);
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
      return this.autocompleteItems.filter((i) => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
  },
};
</script>
