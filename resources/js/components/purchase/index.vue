<template>
  <div>
    <div class="row">
     <router-link to="/store-purchase" class="btn btn-primary">Add Purchase</router-link>
    </div>
    <br>
  

     <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Purchase List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Product Name</th>
                        <th>Supplier Name</th>
                        <th>Photo</th>
                        <th>Quantity</th>
                        <th>Total Cost</th>
                         <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="purchase in purchases" :key="purchase.id">
                        <td>{{ purchase.product_name }}</td>
                        <td>{{ purchase.name }}</td>
                        <td><img :src="purchase.image" id="emp_photo"></td>
                        <td>{{ purchase.quantity }}</td>
                        <td>{{ purchase.total_cost }}</td>
                        
                        <td>
            <router-link :to="{name: 'edit-purchase', params:{id:purchase.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a @click="deletePurchase(purchase.id)" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
      purchases:[]
     
    }
  },
 
  methods:{
    allPurchase(){
       axios.get('/api/purchase')
       .then(({data}) => (this.purchases = data))
       .catch()
    },
    deletePurchase(id){
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
             if (result.value) {
                 axios.delete('/api/purchase/'+id)
                .then(() => {
                   this.purchases = this.purchases.filter(purchase => {
                   return purchase.id != id
                   })
                })
                .catch(() => {
                    this.$router.push({ name: 'purchase'})
                 })

                Swal.fire(
                   'Deleted!',
                   'Your file has been deleted.',
                   'success'
               )
             }
          })

     }



  },
  created(){
    this.allPurchase();
  }
 
}

</script>

<style text="text/css">
 #emp_photo{
    height: 40px;
    width: 40px;
  }
</style>
