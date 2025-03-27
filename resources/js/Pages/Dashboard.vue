<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar Navigation -->
        <div
            class="fixed inset-y-0 left-0 w-64 bg-gray-800 shadow-lg flex flex-col"
        >
            <div class="flex items-center justify-center h-16 px-4 bg-gray-900">
                <span class="text-xl font-semibold text-white">ParkAdmin</span>
            </div>

            <nav class="flex-1 px-4 py-6 overflow-y-auto">
                <ul class="space-y-2">
                    <li v-for="item in navItems" :key="item.name">
                        <a
                            href="#"
                            @click="scrollTo(item.id)"
                            class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors"
                            :class="{
                                'bg-gray-700 text-white':
                                    activeSection === item.id,
                            }"
                        >
                            <component :is="item.icon" class="h-5 w-5 mr-3" />
                            {{ item.name }}
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <button
                    @click="logout"
                    class="flex items-center w-full px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors"
                >
                    <LogoutIcon class="h-5 w-5 mr-3" />
                    Logout
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64">
            <!-- Top Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="flex justify-between items-center h-16 px-6">
                    <h1 class="text-lg font-medium text-gray-900">
                        {{ activeSectionName }} Dashboard
                    </h1>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button
                                class="p-1 text-gray-500 hover:text-gray-700 relative"
                            >
                                <BellIcon class="h-6 w-6" />
                                <span
                                    class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"
                                ></span>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <img
                                class="h-8 w-8 rounded-full"
                                src="https://i.pravatar.cc/150?img=3"
                                alt="User avatar"
                            />
                            <span class="ml-2 text-sm font-medium text-gray-700"
                                >Admin User</span
                            >
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 space-y-8">
                <!-- Overview Section -->
                <section
                    id="overview"
                    class="bg-white rounded-lg shadow overflow-hidden"
                >
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">
                            System Overview
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6">
                        <DashboardCard
                            title="Total Spaces"
                            value="248"
                            icon="ParkingIcon"
                            color="blue"
                            detail="+5 new this month"
                        />
                        <DashboardCard
                            title="Current Occupancy"
                            value="75%"
                            icon="CarIcon"
                            color="green"
                            detail="187/248 spots occupied"
                        />
                        <DashboardCard
                            title="Today's Revenue"
                            value="$3,245"
                            icon="CurrencyDollarIcon"
                            color="purple"
                            detail="12% vs yesterday"
                        />
                        <DashboardCard
                            title="Active Reservations"
                            value="94"
                            icon="CalendarIcon"
                            color="orange"
                            detail="5 pending approval"
                        />
                    </div>
                </section>

                <!-- Quick Actions -->
                <section
                    id="actions"
                    class="bg-white rounded-lg shadow overflow-hidden"
                >
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">
                            Quick Actions
                        </h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6">
                        <ActionButton
                            icon="PlusCircleIcon"
                            label="Add Zone"
                            color="blue"
                            @click="openModal('zone')"
                        />
                        <ActionButton
                            icon="UserAddIcon"
                            label="Create User"
                            color="green"
                            @click="openModal('user')"
                        />
                        <ActionButton
                            icon="AdjustmentsIcon"
                            label="Adjust Rates"
                            color="purple"
                            @click="openModal('rates')"
                        />
                        <ActionButton
                            icon="DocumentReportIcon"
                            label="Generate Report"
                            color="orange"
                            @click="openModal('report')"
                        />
                    </div>
                </section>

                <!-- Recent Activity -->
                <section
                    id="activity"
                    class="bg-white rounded-lg shadow overflow-hidden"
                >
                    <div
                        class="px-6 py-4 border-b border-gray-200 flex justify-between items-center"
                    >
                        <h2 class="text-lg font-medium text-gray-900">
                            Recent Activity
                        </h2>
                        <button
                            class="text-sm text-blue-600 hover:text-blue-800"
                        >
                            View All
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Time
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Event
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        User
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Details
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(activity, index) in recentActivity"
                                    :key="index"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ activity.time }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                    >
                                        {{ activity.event }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ activity.user }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ activity.details }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Parking Zones -->
                <section
                    id="zones"
                    class="bg-white rounded-lg shadow overflow-hidden"
                >
                    <div
                        class="px-6 py-4 border-b border-gray-200 flex justify-between items-center"
                    >
                        <h2 class="text-lg font-medium text-gray-900">
                            Parking Zones
                        </h2>
                        <button
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                        >
                            Add New Zone
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Zone
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Capacity
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Available
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Rate
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="zone in parkingZones" :key="zone.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center"
                                            >
                                                <LocationMarkerIcon
                                                    class="h-5 w-5 text-blue-600"
                                                />
                                            </div>
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900"
                                                >
                                                    {{ zone.name }}
                                                </div>
                                                <div
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ zone.location }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ zone.totalSpots }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ zone.available }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        ${{ zone.rate }}/hr
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        >
                                            {{ zone.status }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                    >
                                        <button
                                            class="text-blue-600 hover:text-blue-900 mr-3"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            class="text-gray-600 hover:text-gray-900"
                                        >
                                            View
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Current Reservations -->
                <section
                    id="reservations"
                    class="bg-white rounded-lg shadow overflow-hidden"
                >
                    <div
                        class="px-6 py-4 border-b border-gray-200 flex justify-between items-center"
                    >
                        <h2 class="text-lg font-medium text-gray-900">
                            Active Reservations
                        </h2>
                        <div class="flex space-x-2">
                            <select class="border-gray-300 rounded-md text-sm">
                                <option>All Zones</option>
                                <option>North Zone</option>
                                <option>South Zone</option>
                            </select>
                            <button
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                            >
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        ID
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Vehicle
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Zone/Spot
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Time
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Amount
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="res in activeReservations"
                                    :key="res.id"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                    >
                                        #{{ res.id }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div>{{ res.plate }}</div>
                                        <div class="text-xs text-gray-400">
                                            {{ res.type }}
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div>{{ res.zone }}</div>
                                        <div class="text-xs text-gray-400">
                                            Spot {{ res.spot }}
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <div>{{ res.entry }}</div>
                                        <div class="text-xs text-gray-400">
                                            to {{ res.exit }}
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        ${{ res.amount }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                    >
                                        <button
                                            class="text-blue-600 hover:text-blue-900 mr-3"
                                        >
                                            Extend
                                        </button>
                                        <button
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Cancel
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>
</template>

<script>
import {
    ChartBarIcon,
    ClockIcon,
    CogIcon,
    CurrencyDollarIcon,
    MapPinIcon as LocationMarkerIcon,
    InformationCircleIcon as ParkingIcon,
    TicketIcon,
    UserGroupIcon,
    BellIcon,
    TruckIcon as CarIcon,
    CalendarIcon,
    ArrowLeftOnRectangleIcon as LogoutIcon,
    PlusCircleIcon,
    UserPlusIcon as UserAddIcon,
    AdjustmentsHorizontalIcon as AdjustmentsIcon,
    DocumentChartBarIcon as DocumentReportIcon,
} from "@heroicons/vue/24/outline";

export default {
    components: {
        ChartBarIcon,
        ClockIcon,
        CogIcon,
        CurrencyDollarIcon,
        LocationMarkerIcon,
        ParkingIcon,
        TicketIcon,
        UserGroupIcon,
        BellIcon,
        CarIcon,
        CalendarIcon,
        LogoutIcon,
        PlusCircleIcon,
        UserAddIcon,
        AdjustmentsIcon,
        DocumentReportIcon,
    },
    data() {
        return {
            activeSection: "overview",
            navItems: [
                { name: "Overview", id: "overview", icon: "ChartBarIcon" },
                { name: "Quick Actions", id: "actions", icon: "ClockIcon" },
                { name: "Recent Activity", id: "activity", icon: "TicketIcon" },
                {
                    name: "Parking Zones",
                    id: "zones",
                    icon: "LocationMarkerIcon",
                },
                {
                    name: "Reservations",
                    id: "reservations",
                    icon: "CalendarIcon",
                },
                { name: "User Management", id: "users", icon: "UserGroupIcon" },
                { name: "Settings", id: "settings", icon: "CogIcon" },
            ],
            recentActivity: [
                {
                    time: "10:42 AM",
                    event: "New Reservation",
                    user: "Customer #1254",
                    details: "North-24 (3 hrs)",
                },
                {
                    time: "10:30 AM",
                    event: "Payment Processed",
                    user: "Customer #9821",
                    details: "$7.50 - South-12",
                },
                {
                    time: "09:15 AM",
                    event: "Zone Modified",
                    user: "Admin User",
                    details: "East Zone rate updated",
                },
                {
                    time: "08:45 AM",
                    event: "User Created",
                    user: "System",
                    details: "johndoe@example.com",
                },
                {
                    time: "Yesterday",
                    event: "Maintenance",
                    user: "Technician",
                    details: "West Zone camera repaired",
                },
            ],
            parkingZones: [
                {
                    id: 1,
                    name: "North Zone",
                    location: "Main Building",
                    totalSpots: 80,
                    available: 12,
                    rate: 3.5,
                    status: "Active",
                },
                {
                    id: 2,
                    name: "South Zone",
                    location: "Secondary Lot",
                    totalSpots: 60,
                    available: 8,
                    rate: 3.0,
                    status: "Active",
                },
                {
                    id: 3,
                    name: "East Zone",
                    location: "Annex Building",
                    totalSpots: 50,
                    available: 5,
                    rate: 4.0,
                    status: "Active",
                },
                {
                    id: 4,
                    name: "West Zone",
                    location: "Visitor Parking",
                    totalSpots: 58,
                    available: 15,
                    rate: 5.0,
                    status: "Maintenance",
                },
            ],
            activeReservations: [
                {
                    id: "1024",
                    plate: "ABC123",
                    type: "Sedan",
                    zone: "North Zone",
                    spot: "24",
                    entry: "10:30 AM",
                    exit: "1:30 PM",
                    amount: "9.50",
                },
                {
                    id: "1023",
                    plate: "XYZ789",
                    type: "SUV",
                    zone: "South Zone",
                    spot: "12",
                    entry: "9:15 AM",
                    exit: "12:30 PM",
                    amount: "9.45",
                },
                {
                    id: "1022",
                    plate: "DEF456",
                    type: "Truck",
                    zone: "East Zone",
                    spot: "05",
                    entry: "8:00 AM",
                    exit: "6:00 PM",
                    amount: "32.00",
                },
                {
                    id: "1021",
                    plate: "GHI789",
                    type: "Sedan",
                    zone: "West Zone",
                    spot: "33",
                    entry: "11:00 AM",
                    exit: "3:00 PM",
                    amount: "15.00",
                },
            ],
        };
    },
    computed: {
        activeSectionName() {
            const item = this.navItems.find(
                (item) => item.id === this.activeSection
            );
            return item ? item.name : "Dashboard";
        },
    },
    methods: {
        scrollTo(id) {
            this.activeSection = id;
            const element = document.getElementById(id);
            if (element) {
                element.scrollIntoView({ behavior: "smooth" });
            }
        },
        logout() {
            // Implement logout logic
            alert("Logging out...");
        },
        openModal(type) {
            alert(`Opening ${type} modal...`);
        },
    },
    mounted() {
        // Set up intersection observer to highlight active section
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        this.activeSection = entry.target.id;
                    }
                });
            },
            { threshold: 0.5 }
        );

        this.navItems.forEach((item) => {
            const element = document.getElementById(item.id);
            if (element) observer.observe(element);
        });
    },
};
</script>

<style>
/* Custom scrollbar for sidebar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #374151;
}

::-webkit-scrollbar-thumb {
    background: #6b7280;
    border-radius: 3px;
}

/* Smooth scrolling for main content */
html {
    scroll-behavior: smooth;
}
</style>
