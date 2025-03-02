<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },

    disabled: {
        type: Boolean,
        default: false,
    },

    label: {
        type: String,
        required: true,
    },
})
</script>

<template>
  <button
    :class="[disabled ? 'bg-gray-400 cursor-not-allowed' : 'border border-green-default text-green-default bg-white hover:bg-green-default hover:text-white']"
    :type="type"
    :disabled="disabled"
    class="shadow-md items-center px-2 py-0.5 rounded-sm text-sm transition ease-in-out duration-150"
  >
    {{ label }}
  </button>
</template>
