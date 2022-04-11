<template>
  
  <div>

 <div class="row">
  <router-link to="/purchase" class="btn btn-primary">All Purchase </router-link>
   
 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Purchase</h1>
                  </div>

      <form class="user" @submit.prevent="PurchaseInsert">

        
       
         <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                 <label for="exampleFormControlSelect1">Product Select</label>
                     <select class="form-control" id="exampleFormControlSelect1" v-model="form.product_id">
                        <option disabled value="">Please select Product</option>
         <option :value="product.id" v-for="product in products"  :key="product">{{ product.product_name }}</option>
                       
                      </select>    
              </div>


             <div class="col-md-6">
                <label for="exampleFormControlSelect1">Product Supplier</label>
                   <select class="form-control" id="exampleFormControlSelect1" v-model="form.supplier_id">
                     <option disabled value="">Please select Supplier</option>
       <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier">{{ supplier.name }}</option> 
                       
                  </select>    
             </div>     
            
          </div>
        </div>

       

        <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Cost</label>
         <input type="text" class="form-control" id="exampleInputFirstName"  placeholder="Enter Your Cost" v-model="form.total_cost">
  <small class="text-danger" v-if="errors.total_cost"> {{ errors.total_cost[0] }} </small>
            </div>


     <div class="col-md-6">
      <label for="exampleFormControlSelect1">Quantity</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Quantity" v-model="form.quantity">
         <small class="text-danger" v-if="errors.quantity"> {{ errors.quantity[0] }} </small>
            </div>     
            
          </div>
        </div>


         <div class="form-group">

          <div class="form-row">
            <div class="col-md-12">
              <label for="exampleFormControlSelect1">Purchasing Date</label>
                <input type="date" class="form-control" id="exampleInputFirstName" v-model="form.purchase_date">
                <small class="text-danger" v-if="errors.purchase_date"> {{ errors.purchase_date[0] }} </small>
            </div>
          </div>

        </div>




        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        
      </form>
                  <hr>
                  <div class="text-center">
  
  
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
  
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
    data(){
    return {
      form:{
        product_id:'',
        supplier_id:'',
        quantity:'',
        total_cost:'',
        purchase_date:''
      },
      errors:{},
      products:{},
      suppliers:{},
    }
  },
  methods:{
   
     PurchaseInsert(){
       axios.post('/api/purchase',this.form)
       .then(() => {
        this.$router.push({ name: 'purchase'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  },
  created(){
    axios.get('/api/product/')
    .then(({data}) => (this.products = data))
    axios.get('/api/supplier/')
    .then(({data}) => (this.suppliers = data))
  } 
  }
   
</script>


<style type="text/css">
  
</style>
