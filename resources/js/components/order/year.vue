<template>
   <div>
      <div class="row">
        <router-link to="/order" class="btn btn-primary">Today Order</router-link>
   
      </div>


     <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Search Order Year Wise</h1>
                  </div>

        <form class="user" @submit.prevent="searchYear">


             <div class="form-group">
                  <h5>Select Year<span class="text-danger">*</span></h5>
                  <div class="controls">
                    <select v-model="year" class="form-control">
			          <option label="Choose Year"></option>
                      <option value="2020">2020</option>
			          <option value="2021">2021</option>
			          <option value="2022">2022</option>
			          <option value="2023">2023</option>
			          <option value="2024">2024</option>
			          <option value="2025">2025</option>
			          <option value="2026">2026</option>
			         

		            </select>  

                  </div>
         
             </div>


           <div class="form-group">
               <button type="submit" class="btn btn-primary btn-block">Search</button>
           </div>

        </form>


        
<div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Customer Name</th>
                        <th>Qty</th>
                        <th>Pay</th>
                        <th>Vat</th>
                        <th>SubTotal</th>
                        <th>Total</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders">
                          <td>{{ order.name }}</td>
                          <td>{{ order.qty }}</td>
                          <td>{{ order.pay }} $</td>
                          <td>{{ order.vat }} %</td>
                          <td>{{ order.sub_total}} $</td>
                          <td>{{ order.total}} $</td>
                      
                      
                       </tr>
                       
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>








                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
      </div>
    </div>
</template>

<script type="text/javascript">
export default{
  
  created(){
    if(!User.loggedIn()){
       this.$router.push({ name: '/'})
    }
  },

  data(){
     return{
        year:'',
        orders:{}
      }
   },
   methods:{
     
     searchYear(){
       var data = {year:this.year}
       axios.post('/api/search/order/year',data)
        .then(({data}) => (this.orders = data))
        .catch(error =>this.errors = error.response.data.errors)
     },
     
   }
}

</script>

<style text="text/css">
</style>
