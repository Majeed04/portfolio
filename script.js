// ============================================================
// ملف جافاسكريبت للتحكم بتفاعلات الموقع
// ==========================================

// ── 1. القائمة العلوية (Navbar): تغيير لون الخلفية عند النزول ──
const navbar = document.getElementById('navbar');

// استماع لحدث النزول بالماوس (Scroll)
window.addEventListener('scroll', () => {
  if (navbar) {
    // إذا نزل المستخدم أكثر من 50 بكسل، أضف كلاس 'scrolled' لتغيير اللون
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  }
}, { passive: true });


// ── 2. زر القائمة في الجوال (Hamburger Menu) ──────────────────
const navToggle = document.getElementById('navToggle');
const navLinks  = document.getElementById('navLinks');

if (navToggle && navLinks) {
  // عند الضغط على زر القائمة، قم بإظهار/إخفاء الروابط
  navToggle.addEventListener('click', () => {
    navToggle.classList.toggle('open');
    navLinks.classList.toggle('open');
  });

  // إغلاق القائمة تلقائياً عند الضغط على أي رابط بداخلها
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navToggle.classList.remove('open');
      navLinks.classList.remove('open');
    });
  });
}


// ── 3. حركات الظهور عند النزول (Scroll Reveal Animation) ──────
// تحديد جميع العناصر التي نريد تطبيق حركة الظهور عليها
const revealElements = document.querySelectorAll(
  '.about-card, .timeline-item, .edu-card, .course-card, .skills-group, .contact-card, .contact-form-wrapper'
);

// إضافة كلاس 'reveal' المبدئي (لإخفاء العناصر قبل ظهورها)
revealElements.forEach(el => el.classList.add('reveal'));

// استخدام IntersectionObserver لمعرفة متى يظهر العنصر في الشاشة
const revealObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry, i) => {
      // إذا دخل العنصر في مجال رؤية الشاشة
      if (entry.isIntersecting) {
        // أضف كلاس 'visible' ليظهر بتأثير حركي جميل
        setTimeout(() => entry.target.classList.add('visible'), i * 90);
        revealObserver.unobserve(entry.target); // التوقف عن المراقبة بعد ظهوره
      }
    });
  },
  { threshold: 0.12 }
);

// تفعيل المراقبة على كل العناصر المحددة
revealElements.forEach(el => revealObserver.observe(el));


// ── 4. تحديث السنة تلقائياً في أسفل الموقع ─────────────────────
const yearSpan = document.getElementById('year');
if (yearSpan) {
  // جلب السنة الحالية من نظام المستخدم وطباعتها
  yearSpan.textContent = new Date().getFullYear();
}


// ── 5. تظليل الرابط النشط في القائمة حسب القسم المعروض ────────
const sections = document.querySelectorAll('section');
const navItems = document.querySelectorAll('.nav-links a');

window.addEventListener('scroll', () => {
  let current = '';
  // معرفة أي قسم هو المعروض حالياً في الشاشة
  sections.forEach(section => {
    const sectionTop = section.offsetTop;
    if (pageYOffset >= (sectionTop - 200)) {
      current = section.getAttribute('id');
    }
  });

  // إزالة التظليل عن جميع الروابط ووضعه على الرابط الخاص بالقسم الحالي فقط
  navItems.forEach(a => {
    a.classList.remove('active');
    if (a.getAttribute('href') === `#${current}`) {
      a.classList.add('active');
    }
  });
});


// ── 6. الوضع الليلي والنهاري (Dark/Light Mode) ────────────────
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const htmlEl = document.documentElement;

// التحقق مما إذا كان المستخدم قد حفظ تفضيلاته سابقاً في المتصفح (localStorage)
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
  htmlEl.setAttribute('data-theme', savedTheme);
  updateThemeIcon(savedTheme);
}

if (themeToggle) {
  // عند الضغط على زر الشمس/القمر
  themeToggle.addEventListener('click', () => {
    // معرفة الوضع الحالي، ثم تبديله
    const currentTheme = htmlEl.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    // تطبيق الوضع الجديد
    htmlEl.setAttribute('data-theme', newTheme);
    
    // حفظ الوضع الجديد في المتصفح ليبقى حتى لو تم تحديث الصفحة
    localStorage.setItem('theme', newTheme);
    
    // تغيير شكل الأيقونة
    updateThemeIcon(newTheme);
  });
}

// دالة لتغيير الأيقونة بناءً على الوضع
function updateThemeIcon(theme) {
  if (theme === 'light') {
    themeIcon.classList.remove('fa-sun');
    themeIcon.classList.add('fa-moon');
  } else {
    themeIcon.classList.remove('fa-moon');
    themeIcon.classList.add('fa-sun');
  }
}
