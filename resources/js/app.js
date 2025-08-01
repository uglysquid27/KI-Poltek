import './bootstrap';

// API Configuration
const API_BASE_URL = 'https://open-api.my.id/api/wilayah';

// API Functions
async function getProvinces() {
  try {
    const response = await fetch(`${API_BASE_URL}/provinces`);
    if (!response.ok) throw new Error('Failed to fetch provinces');
    return await response.json();
  } catch (error) {
    console.error('Error fetching provinces:', error);
    return [];
  }
}

async function getRegencies(provinceId) {
  try {
    const response = await fetch(`${API_BASE_URL}/regencies/${provinceId}`);
    if (!response.ok) throw new Error('Failed to fetch regencies');
    return await response.json();
  } catch (error) {
    console.error('Error fetching regencies:', error);
    return [];
  }
}

async function getDistricts(regencyId) {
  try {
    const response = await fetch(`${API_BASE_URL}/districts/${regencyId}`);
    if (!response.ok) throw new Error('Failed to fetch districts');
    return await response.json();
  } catch (error) {
    console.error('Error fetching districts:', error);
    return [];
  }
}

// Region Selector Initialization
async function initRegionSelectors(provinsiSelector, kabupatenSelector, kecamatanSelector, oldValues = {}) {
  const provinsiEl = document.querySelector(provinsiSelector);
  const kabupatenEl = document.querySelector(kabupatenSelector);
  const kecamatanEl = document.querySelector(kecamatanSelector);

  if (!provinsiEl || !kabupatenEl || !kecamatanEl) return;

  // Load Provinces
  try {
    const provinces = await getProvinces();
    provinsiEl.innerHTML = '<option value="">Pilih Provinsi</option>';
    
    provinces.forEach(province => {
      const option = new Option(province.name, province.id);
      provinsiEl.add(option);
    });

    // Set old value if exists
    if (oldValues.provinsi) {
      provinsiEl.value = oldValues.provinsi;
      setTimeout(() => provinsiEl.dispatchEvent(new Event('change')), 100);
    }
  } catch (error) {
    console.error('Error loading provinces:', error);
  }

  // Province Change Handler
  const handleProvinceChange = async () => {
    const provinceId = provinsiEl.value;
    kabupatenEl.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
    kecamatanEl.innerHTML = '<option value="">Pilih Kecamatan</option>';
    kabupatenEl.disabled = !provinceId;
    kecamatanEl.disabled = true;

    if (provinceId) {
      try {
        const regencies = await getRegencies(provinceId);
        regencies.forEach(regency => {
          const option = new Option(regency.name, regency.id);
          kabupatenEl.add(option);
        });

        if (oldValues.kabupaten) {
          kabupatenEl.value = oldValues.kabupaten;
          setTimeout(() => kabupatenEl.dispatchEvent(new Event('change')), 100);
        }
      } catch (error) {
        console.error('Error loading regencies:', error);
      }
    }
  };

  // Regency Change Handler
  const handleRegencyChange = async () => {
    const regencyId = kabupatenEl.value;
    kecamatanEl.innerHTML = '<option value="">Pilih Kecamatan</option>';
    kecamatanEl.disabled = !regencyId;

    if (regencyId) {
      try {
        const districts = await getDistricts(regencyId);
        districts.forEach(district => {
          const option = new Option(district.name, district.id);
          kecamatanEl.add(option);
        });

        if (oldValues.kecamatan) {
          kecamatanEl.value = oldValues.kecamatan;
        }
      } catch (error) {
        console.error('Error loading districts:', error);
      }
    }
  };

  // Event Listeners
  provinsiEl.addEventListener('change', handleProvinceChange);
  kabupatenEl.addEventListener('change', handleRegencyChange);
}

// Initialize on DOM Load
document.addEventListener('DOMContentLoaded', function() {
  // Pass old form values from Laravel
  const oldValues = {
    provinsi: window.oldPenciptaProvinsi || null,
    kabupaten: window.oldPenciptaKabupaten || null,
    kecamatan: window.oldPenciptaKecamatan || null
  };

  // Main creator
  initRegionSelectors(
    '#pencipta_provinsi',
    '#pencipta_kabupaten',
    '#pencipta_kecamatan',
    oldValues
  );

  // Existing additional members
  document.querySelectorAll('.anggota-pencipta-item').forEach((item, index) => {
    initRegionSelectors(
      `#anggota_provinsi_${index}`,
      `#anggota_kabupaten_${index}`,
      `#anggota_kecamatan_${index}`,
      {
        provinsi: window[`oldAnggotaProvinsi_${index}`],
        kabupaten: window[`oldAnggotaKabupaten_${index}`],
        kecamatan: window[`oldAnggotaKecamatan_${index}`]
      }
    );
  });
});

// For dynamic field addition
function addAnggotaPenciptaField() {
  const currentIndex = anggotaPenciptaContainer.children.length;
  const div = document.createElement('div');
  // ... your existing HTML structure ...
  
  anggotaPenciptaContainer.appendChild(div);

  // Initialize region selectors for new member
  initRegionSelectors(
    `#anggota_provinsi_${currentIndex}`,
    `#anggota_kabupaten_${currentIndex}`,
    `#anggota_kecamatan_${currentIndex}`
  );
}