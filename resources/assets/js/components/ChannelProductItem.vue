<template>
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

        <!-- Year Field -->
        <div class="form-group col-sm-6">
            <label>年期:</label>
            <input type="number" name="year" class="form-control" disabled v-model="productYear">
        </div>

        <!-- Year Period Count Field -->
        <div class="form-group col-sm-6">
            <label>年期段:</label>
            <select name="year_period_count" class="form-control" v-on:change="yearChange" v-model="yearPeriodCount">
                <option v-for="n in 6">{{ n }}</option>
            </select>
        </div>

        <!-- Year Period Field -->
        <div v-for="(index,item) in yearPeriod">
            <div class="form-group col-sm-2">
                <label>第{{index+1}}段:第</label>
                <select name="year_period[{{index}}][start]" class="selector">
                    <option v-for="n in 11">{{ n }}</option>
                </select>
                <label>年</label>
            </div>
            <div class="form-group col-sm-2">
                <label>第</label>
                <select name="year_period[{{index}}][end]" class="selector">
                    <option v-for="n in 11">{{ n }}</option>
                </select>
                <label>年：</label>
            </div>
            <div class="form-group col-sm-2">
                <input type="text" name="year_period[{{index}}][rate]">
                <label>%倍</label>
            </div>
        </div>
    </div>

    <div v-show="isTypeA">
        <!-- Rate Field -->
        <div class="form-group col-sm-6">
            <label>倍数:(单位%)</label>
            <input type="text" name="rate" class="form-control" required v-model="productRate">％
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            productType: '',
            productSupplier: '',
            productPlan: '',
            productYear: 0,
            productRate: 0,
            yearPeriodCount: 0,
            yearPeriod: [],
            isTypeB: '',
            isTypeA: ''
        },
        ready () {
            this.typeChange();
            for(let i=0;i<this.yearPeriodCount;i++){
                $("[name='year_period["+i+"][start]']").val(this.yearPeriod[i]['start']);
                $("[name='year_period["+i+"][end]']").val(this.yearPeriod[i]['end']);
                $("[name='year_period["+i+"][rate]']").val(this.yearPeriod[i]['rate']);
            }
        },
        methods: {
            yearChange(){
                this.yearPeriodCount =  parseInt($("*[name='year_period_count']").val());
                this.yearPeriod = [];
                for(let i=0;i<this.yearPeriodCount;i++){
                    this.yearPeriod.push({
                        start:'',
                        end:'',
                        rate:''
                    });
                }
            },
            typeChange(){
                if(this.productType == 'B'){
                    this.isTypeB = true;
                    this.isTypeA = false;
                }else if(this.productType == 'A'){
                    this.isTypeB = false;
                    this.isTypeA = true;
                }
            }
        }
    }
</script>