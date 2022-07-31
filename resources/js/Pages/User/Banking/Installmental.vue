<script setup>
import Payment from '@/Components/Pay.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, reactive, computed } from 'vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
  errors: Object,
})

const periodLength = ref(0);

function period(){
  if(form.period == 'Months'){
    periodLength.value = computed(() => {
      return form.length * 12000
    });
  }else{
    periodLength.value = computed(() => {
      return form.length * 120000
    });
  }
}

const form = reactive({
    period: '',
    length: 1,
    amount: 0,
});


function onlyNumber($event) {
    let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
    if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
        $event.preventDefault();
    }   
}

function increaseButton(){
    form.length++;
}

function decreaseButton(){
    form.length--
}

function submit() {
    Inertia.post(route('demo.installmental.pay'), form);       
}

</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>

    <Head />
    
    <Payment>
      <div>
        <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY INSTALLMENTALLY</p>
      </div>

      <div class="flex justify-center items-center w-1/2 bg-gray-800 rounded-md p-8 mx-auto mb-5">
        <form class="w-full">
          <div class="text-gray-300">
            <h1 class="text-xl text-center font-semibold">1 Month = &#8358; 12,000.00</h1>
            <h1 class="text-xl text-center font-semibold">1 Year = &#8358; 120,000.00</h1>
            <div class="space-y-5 mt-6">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Name: </span>
                <span>Nwoko James</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Email: </span>
                <span>nwokojames@james.com</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Payment for: </span>
                <span>House/Lodge Rent</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Amount: </span>
                <span>&#8358; {{ periodLength }}</span>
              </div>
            </div>

            <form>
                <label class="block mt-4">
                    <span class="text-gray-300 text-lg pt-4 pb-2 block font-semibold">Period</span>
                    <select @click="period" id="gender" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.period"  required>
                        <option value="" selected="selected" disabled>~ Select ~</option>
                        <option value="Months">Month/Months</option>
                        <option value="Years">Year/Years</option>
                    </select>
                    <p v-if="errors.period" class="text-sm text-red-500">{{ errors.period }}</p>
                </label>
                <div class="grid grid-cols-3 border border-purple-400 mt-8">
                  <button
                      class="text-4xl flex justify-center items-center text-gray-200"
                      type="button"
                      @click="decreaseButton"
                      
                  >-</button>
                  <input 
                      type="text" 
                      @keypress="onlyNumber"
                      class="py-3 text-center focus:border-purple-400 focus:outline-none focus:shadow-outline-purple-400 text-gray-800" 
                      v-model="form.length"
                  />

                  <button 
                      class="text-4xl flex justify-center items-center text-gray-200"
                      type="button"
                      @click="increaseButton"
                  >+</button>
              </div>
            </form>

            <div class="flex justify-center items-center">
              <input 
                type="button" 
                onclick="return confirm('Do you want to accept this order?')"
                @click="submit" 
                class="inline-block border border-black px-8 py-2 mt-5 rounded-md" 
                value="Pay">
            </div>
          </div>
        </form>
      </div>
    </Payment>

</template>