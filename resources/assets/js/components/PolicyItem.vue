<template>
    <div class="form-group col-sm-6">
        <label>产品类型:</label>
        <select name="type" class="form-control" required v-on:change="typeChange" v-model="productType">
            <option>A</option>
            <option>B</option>
        </select>
    </div>

    <!-- Product Name Field -->
    <div class="form-group col-sm-6">
        <label>产品:</label>
        <select name="product_id" class="form-control" required v-model="productId" v-on:change="productChange">
            <option v-for="(index,product) in products" value="{{index}}">{{ product }}</option>
        </select>
    </div>

    <div v-show="isTypeB">
        <!-- Supplier Field -->
        <div class="form-group col-sm-6">
            <label>产品供应商:</label>
            <input type="text" name="supplier" class="form-control" disabled v-model="productSupplier">
        </div>

        <!-- Plan Field -->
        <div class="form-group col-sm-6">
            <label>计划名称:</label>
            <input type="text" name="plan" class="form-control" disabled v-model="productPlan">
        </div>
    </div>

    <div v-show="isTypeA">
        <!-- Rate Field -->
        <div class="form-group col-sm-6">
            <label>倍数:(单位%)</label>
            <input type="text" name="rate" class="form-control" disabled v-model="productRate">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            productType: '',
            productId: '',
            productData: '',
            products: '',
            productsOfA: '',
            productsOfB: '',
            productSupplier: '',
            productPlan: '',
            productRate: 0,
            isTypeB: '',
            isTypeA: ''
        },
        ready () {
            if (this.productType){
                //修改保单
                $("[name='type']").prop('disabled',true);
                $("[name='product_id']").prop('disabled',true);
            }
            this.typeChange();
            this.productChange();
        },
        methods: {
            typeChange(){
                if(this.productType == 'B'){
                    this.isTypeB = true;
                    this.isTypeA = false;
                    this.products = this.productsOfB;
                    $("[name='supplier']").prop('required',true);
                    $("[name='plan']").prop('required',true);
                    $("[name='rate']").prop('required',false);
                }else if(this.productType == 'A'){
                    this.isTypeB = false;
                    this.isTypeA = true;
                    this.products = this.productsOfA;
                    $("[name='supplier']").prop('required',false);
                    $("[name='plan']").prop('required',false);
                    $("[name='rate']").prop('required',true);
                }
            },
            productChange(){
                let data = this.productData;
                for(let i=0;i<data.length;i++){
                    if(this.productId == data[i]['id']){
                        this.productSupplier = data[i]['supplier'];
                        this.productPlan = data[i]['plan'];
                        this.productRate = data[i]['rate'];
                    }
                }
            }
        }
    }
</script>