import './bootstrap';
import 'preline';
import 'flowbite';

import AOS from 'aos';
import 'aos/dist/aos.css';

// Khởi tạo AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: false,  // Set false để animation chạy mỗi lần scroll
    mirror: true  // Set true để animation chạy khi scroll ngược lại
});

// Khởi tạo lại drawer menu
document.addEventListener('DOMContentLoaded', function() {
    const drawer = document.getElementById('drawer-navigation');
    if (drawer) {
        const initDrawer = new Drawer(drawer);
    }
});
