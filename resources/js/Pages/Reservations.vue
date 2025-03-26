<script setup>
import NavBar from "@/Components/NavBar.vue";
import FooterSection from "@/Components/FooterSection.vue";
const form = ref({
    vehicleType: "",
    licensePlate: "",
    entryDateTime: "",
    exitDateTime: "",
    zone: "",
    spotType: "standard",
    specialRequests: "",
});
</script>
<template>
    <div class="bg-gray-900 min-h-screen">
        <!-- Top Navigation Bar -->

        <NavBar />
        <!-- Main Content Area -->
        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Form Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">
                    New Parking Reservation
                </h1>
                <p class="text-gray-400 mt-2">
                    Fill in the details below to reserve your parking spot
                </p>
            </div>

            <!-- Two-Column Layout -->
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Column - Form -->
                <div class="flex-1 bg-gray-800 rounded-xl shadow-lg p-8">
                    <!-- Vehicle Section -->
                    <section class="mb-10">
                        <h2
                            class="text-xl font-semibold text-white mb-6 pb-2 border-b border-gray-700 flex items-center"
                        >
                            <svg
                                class="h-5 w-5 text-emerald-400 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
                                />
                            </svg>
                            Vehicle Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    License Plate
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    v-model="form.licensePlate"
                                    type="text"
                                    required
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                    placeholder="e.g. LT123AB"
                                />
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Vehicle Type
                                    <span class="text-red-500">*</span>
                                </label>
                                <select
                                    v-model="form.vehicleType"
                                    required
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                >
                                    <option value="" disabled selected>
                                        Select vehicle type
                                    </option>
                                    <option value="car">Car</option>
                                    <option value="suv">SUV</option>
                                    <option value="truck">Truck</option>
                                    <option value="motorcycle">
                                        Motorcycle
                                    </option>
                                </select>
                            </div>
                        </div>
                    </section>

                    <!-- Time Selection Section -->
                    <section class="mb-10">
                        <h2
                            class="text-xl font-semibold text-white mb-6 pb-2 border-b border-gray-700 flex items-center"
                        >
                            <svg
                                class="h-5 w-5 text-emerald-400 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            Time Selection
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Entry Date & Time
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    v-model="form.entryDateTime"
                                    type="datetime-local"
                                    :min="minEntryDateTime"
                                    required
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                />
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Exit Date & Time
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    v-model="form.exitDateTime"
                                    type="datetime-local"
                                    :min="
                                        form.entryDateTime || minEntryDateTime
                                    "
                                    required
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                />
                            </div>
                        </div>
                    </section>

                    <!-- Parking Selection Section -->
                    <section class="mb-10">
                        <h2
                            class="text-xl font-semibold text-white mb-6 pb-2 border-b border-gray-700 flex items-center"
                        >
                            <svg
                                class="h-5 w-5 text-emerald-400 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                            Parking Selection
                        </h2>

                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Parking Zone
                                    <span class="text-red-500">*</span>
                                </label>
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"
                                >
                                    <button
                                        v-for="zone in zones"
                                        :key="zone.id"
                                        @click="form.zone = zone.id"
                                        :class="[
                                            'p-4 border rounded-lg transition-all text-left',
                                            form.zone === zone.id
                                                ? 'border-emerald-500 bg-emerald-500/10'
                                                : 'border-gray-600 hover:border-gray-500',
                                        ]"
                                    >
                                        <h3 class="font-medium text-white">
                                            {{ zone.name }}
                                        </h3>
                                        <p class="text-sm text-gray-400 mt-1">
                                            {{ zone.availableSpots }} spots
                                            available
                                        </p>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                >
                                    Spot Type
                                    <span class="text-red-500">*</span>
                                </label>
                                <div
                                    class="grid grid-cols-1 md:grid-cols-3 gap-4"
                                >
                                    <button
                                        v-for="spotType in spotTypes"
                                        :key="spotType.value"
                                        @click="form.spotType = spotType.value"
                                        :class="[
                                            'p-4 border rounded-lg transition-all',
                                            form.spotType === spotType.value
                                                ? 'border-emerald-500 bg-emerald-500/10'
                                                : 'border-gray-600 hover:border-gray-500',
                                        ]"
                                    >
                                        <div class="flex items-center">
                                            <div
                                                :class="[
                                                    'w-5 h-5 rounded-full border mr-3 flex-shrink-0',
                                                    form.spotType ===
                                                    spotType.value
                                                        ? 'border-emerald-500 bg-emerald-500'
                                                        : 'border-gray-400',
                                                ]"
                                            ></div>
                                            <div>
                                                <h3
                                                    class="font-medium text-white"
                                                >
                                                    {{ spotType.label }}
                                                </h3>
                                                <p
                                                    class="text-sm text-gray-400"
                                                >
                                                    {{ spotType.price }}/hour
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Special Requests -->
                    <section>
                        <label
                            class="block text-sm font-medium text-gray-300 mb-2"
                        >
                            Special Requests
                        </label>
                        <textarea
                            v-model="form.specialRequests"
                            rows="3"
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                            placeholder="Any special requirements (disabled access, oversized vehicle, etc)..."
                        ></textarea>
                    </section>
                </div>

                <!-- Right Column - Summary -->
                <div class="w-full lg:w-96">
                    <div
                        class="bg-gray-800 rounded-xl shadow-lg overflow-hidden sticky top-8"
                    >
                        <!-- Availability Status -->
                        <div class="p-6 border-b border-gray-700">
                            <h3 class="text-lg font-medium text-white mb-2">
                                Availability Status
                            </h3>
                            <div
                                v-if="availabilityLoading"
                                class="flex items-center text-gray-400"
                            >
                                <svg
                                    class="animate-spin h-4 w-4 mr-2 text-emerald-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                Checking availability...
                            </div>
                            <div
                                v-else-if="isAvailable"
                                class="flex items-center text-emerald-400"
                            >
                                <svg
                                    class="h-5 w-5 mr-2"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                                Spots available for your selection
                            </div>
                            <div v-else class="flex items-center text-red-400">
                                <svg
                                    class="h-5 w-5 mr-2"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                                No available spots for selected criteria
                            </div>
                        </div>

                        <!-- Reservation Summary -->
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-white mb-4">
                                Reservation Summary
                            </h3>

                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Vehicle:</span>
                                    <span class="text-white">{{
                                        form.vehicleType || "Not selected"
                                    }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-400"
                                        >License Plate:</span
                                    >
                                    <span class="text-white">{{
                                        form.licensePlate || "Not provided"
                                    }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-400">Duration:</span>
                                    <span class="text-white"
                                        >{{ durationHours }} hours</span
                                    >
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-400">Zone:</span>
                                    <span class="text-white">{{
                                        selectedZone.zone.name || "Not selected"
                                    }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-400"
                                        >Spot Type:</span
                                    >
                                    <span class="text-white">{{
                                        selectedSpotType.label || "Not selected"
                                    }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-400"
                                        >Hourly Rate:</span
                                    >
                                    <span class="text-white">{{
                                        selectedSpotType.price || "-"
                                    }}</span>
                                </div>

                                <div
                                    class="border-t border-gray-700 my-3"
                                ></div>

                                <div class="flex justify-between">
                                    <span class="text-gray-400"
                                        >Estimated Total:</span
                                    >
                                    <span
                                        class="text-emerald-400 font-bold text-xl"
                                        >${{ estimatedTotal.toFixed(2) }}</span
                                    >
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button
                                @click="submitReservation"
                                :disabled="!isAvailable || isSubmitting"
                                :class="[
                                    'w-full mt-6 py-3 px-4 rounded-lg font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors',
                                    isAvailable
                                        ? 'bg-emerald-600 hover:bg-emerald-700'
                                        : 'bg-gray-600 cursor-not-allowed',
                                ]"
                            >
                                <span v-if="!isSubmitting"
                                    >Confirm Reservation</span
                                >
                                <span
                                    v-else
                                    class="flex items-center justify-center"
                                >
                                    <svg
                                        class="animate-spin h-5 w-5 mr-2 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>

                            <p class="text-xs text-gray-500 mt-3">
                                By confirming, you agree to our
                                <a
                                    href="#"
                                    class="text-emerald-400 hover:underline"
                                    >Terms of Service</a
                                >.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, watch } from "vue";

export default {
    setup() {
        // Form data

        // Mock data - replace with API calls in production
        const zones = ref([
            { id: "north", name: "North Zone", availableSpots: 12 },
            { id: "south", name: "South Zone", availableSpots: 8 },
            { id: "east", name: "East Zone", availableSpots: 5 },
            { id: "west", name: "West Zone", availableSpots: 15 },
        ]);

        const spotTypes = ref([
            { value: "standard", label: "Standard", price: "$3.50" },
            { value: "covered", label: "Covered", price: "$5.00" },
            { value: "premium", label: "Premium", price: "$7.00" },
        ]);

        // UI states
        const isAvailable = ref(false);
        const availabilityLoading = ref(false);
        const isSubmitting = ref(false);

        // Computed properties
        const minEntryDateTime = computed(() => {
            const now = new Date();
            // Round to nearest 15 minutes
            const minutes = Math.ceil(now.getMinutes() / 15) * 15;
            now.setMinutes(minutes);
            now.setSeconds(0);
            return now.toISOString().slice(0, 16);
        });

        const selectedSpotType = computed(() => {
            return (
                spotTypes.value.find(
                    (st) => st.value === form.value.spotType
                ) || {}
            );
        });

        const selectedZone = computed(() => {
            return zones.value.find((z) => z.id === form.value.zone) || {};
        });

        const durationHours = computed(() => {
            if (!form.value.entryDateTime || !form.value.exitDateTime) return 0;

            const entry = new Date(form.value.entryDateTime);
            const exit = new Date(form.value.exitDateTime);
            const diffMs = exit - entry;

            return Math.round(diffMs / (1000 * 60 * 60) || 0);
        });

        const estimatedTotal = computed(() => {
            if (!durationHours.value) return 0;

            const priceMap = {
                standard: 3.5,
                covered: 5.0,
                premium: 7.0,
            };

            const hourlyRate = priceMap[form.value.spotType] || 0;
            let total = durationHours.value * hourlyRate;

            // Apply daily maximum
            const dailyCap =
                {
                    standard: 25,
                    covered: 35,
                    premium: 45,
                }[form.value.spotType] || Infinity;

            const days = Math.ceil(durationHours.value / 24);
            const cappedTotal = Math.min(total, days * dailyCap);

            return cappedTotal;
        });

        // Methods
        const checkAvailability = () => {
            if (
                !form.value.zone ||
                !form.value.entryDateTime ||
                !form.value.exitDateTime
            ) {
                isAvailable.value = false;
                return;
            }

            availabilityLoading.value = true;

            // Simulate API call
            setTimeout(() => {
                // Mock availability logic - in real app, call your backend
                isAvailable.value = Math.random() > 0.3; // 70% chance of availability
                availabilityLoading.value = false;
            }, 800);
        };

        const submitReservation = () => {
            isSubmitting.value = true;

            // Simulate API submission
            setTimeout(() => {
                alert(
                    `Reservation confirmed!\nLicense: ${
                        form.value.licensePlate
                    }\nTotal: $${estimatedTotal.value.toFixed(2)}`
                );
                isSubmitting.value = false;
            }, 1500);
        };

        // Watchers
        watch(
            [
                () => form.value.zone,
                () => form.value.entryDateTime,
                () => form.value.exitDateTime,
                () => form.value.spotType,
            ],
            checkAvailability
        );

        return {
            form,
            zones,
            spotTypes,
            isAvailable,
            availabilityLoading,
            isSubmitting,
            minEntryDateTime,
            selectedSpotType,
            selectedZone,
            durationHours,
            estimatedTotal,
            checkAvailability,
            submitReservation,
        };
    },
};
</script>

<style>
/* Custom datetime-local input styling */
input[type="datetime-local"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 0.8;
    cursor: pointer;
}

/* Custom radio button styling */
input[type="radio"]:checked + div > div:first-child {
    border-width: 4px;
    border-color: #10b981;
}

/* Smooth transitions */
button,
input,
select,
textarea {
    transition: all 0.2s ease;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #1f2937;
}

::-webkit-scrollbar-thumb {
    background: #374151;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #4b5563;
}
</style>
