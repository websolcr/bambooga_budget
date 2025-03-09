<template>
    <div :class="{'bg-green-50': isExpanded}">
      <div
        class="flex divide-x divide-green-default"
      >
        <div
          class="p-3 text-sm flex items-center justify-center text-center w-1/2"
        >
            ගාස්තුව
        </div>  
        <div
          class="p-3 text-sm flex items-center justify-center text-center w-1/2"
        >
            වලංගු දිනය
        </div>     
      </div>  
    </div>
  </template>
  
  <script>
    
  export default {
      name: 'IncomeSourceDetailsHeading',

      components: {
        
      },
  
    data() {
        return {
            isExpanded: false,
        }
    },
}
  </script>