<script setup>
import { onMounted, ref} from 'vue'

let props = defineProps({
    modelValue: [String, Number],

    disabled: {
        type: Boolean,
        default: () => false,
    },
})

defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus()
    }
})
</script>

<template>
  <input
    ref="input"
    :disabled="disabled"
    class=" focus:border-green-default focus:ring focus:ring-green-default focus:ring-opacity-50 rounded-md shadow-sm text-sm"
    :class="{'bg-gray-100 cursor-not-allowed': disabled}"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >
</template>
