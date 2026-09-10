<?php
session_start();

// Cek autentikasi
// PORTOFOLIO DEMO: gate login dihilangkan — halaman ini bagian dari showcase
// publik, jadi datanya harus langsung bisa diakses tanpa perlu login manual dulu.
$_SESSION['login_simasrim'] = true;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMSRM Link Manager</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Vue 3 -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

    <style>
        /* Menggunakan standar CSS dari portal */
        body {
            font-family: 'Inter', sans-serif;
            color: #fff;
            min-height: 100vh;
        }
        
        .manager-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 10;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            padding: 1.5rem 2rem;
            border-radius: 16px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .header-top h1 {
            margin: 0;
            font-size: 1.5rem;
            background: linear-gradient(to right, #ff903b, #f3700d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-logout {
            color: #ef4444;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            background: rgba(239, 68, 68, 0.1);
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .layout-grid {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }

        .sidebar {
            width: 250px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 1rem;
            backdrop-filter: blur(12px);
            flex-shrink: 0;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            background: transparent;
            color: var(--text-muted);
            border: 1px solid transparent;
            padding: 12px 15px;
            border-radius: 8px;
            cursor: pointer;
            text-align: left;
            font-size: 1rem;
            transition: all 0.3s;
            margin-bottom: 5px;
            font-family: 'Inter', sans-serif;
        }

        .tab-btn:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }

        .tab-btn.active {
            background: rgba(243, 112, 13, 0.15);
            border: 1px solid rgba(243, 112, 13, 0.3);
            color: #fff;
        }
        .tab-btn.active i {
            color: var(--accent);
        }

        .content-area {
            flex: 1;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 2rem;
            backdrop-filter: blur(12px);
            min-height: 500px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }

        .content-header h2 {
            margin: 0 0 5px 0;
            font-size: 1.4rem;
        }

        .content-header p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-save {
            background: var(--accent);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }
        .btn-save:hover {
            background: var(--accent-hover);
        }
        .btn-save:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-preview {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-preview:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.2rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        .form-control {
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(0, 0, 0, 0.2);
            color: white;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: var(--accent);
            background: rgba(0, 0, 0, 0.4);
        }

        .section-box {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .section-header input {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--accent);
            background: transparent;
            border: none;
            border-bottom: 1px dashed rgba(255,255,255,0.3);
            padding: 5px;
            width: 60%;
        }
        .section-header input:focus {
            border-bottom-color: var(--accent);
            outline: none;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 15px;
        }

        .item-row {
            display: flex;
            gap: 15px;
            align-items: flex-end;
            background: rgba(0,0,0,0.2);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .item-row .form-group {
            margin-bottom: 0;
            flex: 1;
        }

        .btn-icon {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            flex-shrink: 0;
        }
        .btn-icon:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .btn-add {
            background: rgba(255,255,255,0.05);
            color: var(--accent);
            border: 1px dashed rgba(243, 112, 13, 0.4);
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
            margin-top: 10px;
        }
        .btn-add:hover {
            background: rgba(243, 112, 13, 0.1);
            border-color: var(--accent);
        }

        /* Checkbox style */
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.85rem;
            cursor: pointer;
        }

        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(12px);
            padding: 15px 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            z-index: 100;
            transition: all 0.3s;
            opacity: 0;
            transform: translateY(20px);
            pointer-events: none;
        }
        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
        .toast.success i { color: #22c55e; }
        .toast.error i { color: #ef4444; }

        @media (max-width: 768px) {
            .manager-container {
                padding: 1rem;
            }
            .header-top {
                flex-direction: column;
                gap: 15px;
                text-align: center;
                padding: 1rem;
            }
            .header-top h1 {
                font-size: 1.25rem;
            }
            .layout-grid {
                flex-direction: column;
                gap: 1.5rem;
            }
            .sidebar {
                width: 100%;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 10px;
                padding: 1rem;
            }
            .sidebar p {
                width: 100%;
                text-align: center;
                margin-bottom: 5px;
            }
            .tab-btn {
                width: calc(33.333% - 7px);
                justify-content: center;
                text-align: center;
                padding: 10px 5px;
                font-size: 0.85rem;
                flex-direction: column;
                gap: 5px;
                margin-bottom: 0;
            }
            .tab-btn i {
                font-size: 1.25rem;
            }
            .content-area {
                padding: 1.25rem;
                min-height: auto;
            }
            .content-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .header-actions {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .btn-save, .btn-preview {
                width: 100%;
                justify-content: center;
            }
            .grid-2, .grid-3 {
                grid-template-columns: 1fr;
            }
            .item-row {
                flex-direction: column;
                align-items: stretch;
            }
            .item-row .form-group {
                width: 100%;
            }
            /* Remove width:100% for .btn-icon so delete buttons don't overflow */
            .form-group[style*="grid-column"] {
                grid-column: span 1 !important;
            }
            .section-box {
                padding: 1rem;
            }
            .preview-section {
                display: none; /* Hide preview on mobile */
            }
        }
    </style>
</head>
<body>
    
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <div id="app" class="manager-container" v-cloak>
        
        <div class="header-top">
            <h1><i class="ph-bold ph-kanban"></i> SMSRM Link Manager</h1>
            <a href="../../index.php" class="btn-logout" style="background: rgba(243, 112, 13, 0.1); color: var(--accent); border-color: rgba(243, 112, 13, 0.2);"><i class="ph-bold ph-arrow-left"></i> Back to MKT Hub</a>
        </div>

        <div class="layout-grid">
            
            <div class="sidebar">
                <p style="color:var(--text-muted); font-size:0.8rem; text-transform:uppercase; margin-bottom:10px; font-weight:bold;">Menu Pengaturan</p>
                
                <button @click="activeTab = 'sta'" class="tab-btn" :class="{active: activeTab === 'sta'}">
                    <i class="ph-bold ph-storefront"></i> Albani Store (STA)
                </button>
                <button @click="activeTab = 'smr'" class="tab-btn" :class="{active: activeTab === 'smr'}">
                    <i class="ph-bold ph-info"></i> Info Pusat (SMR)
                </button>
                <button @click="activeTab = 'portal'" class="tab-btn" :class="{active: activeTab === 'portal'}">
                    <i class="ph-bold ph-layout"></i> Portal Eksekutif
                </button>
            </div>

            <div class="content-area">
                
                <div v-if="loading" style="text-align:center; padding: 50px; color:var(--text-muted);">
                    <i class="ph-bold ph-spinner ph-spin" style="font-size:3rem; color:var(--accent);"></i>
                    <p>Memuat data...</p>
                </div>

                <!-- STA -->
                <div v-else-if="activeTab === 'sta'">
                    <div class="content-header">
                        <div>
                            <h2>STA (Albani Store)</h2>
                            <p>Edit judul, subjudul, dan tautan Linktree Albani Store.</p>
                        </div>
                        <div class="header-actions">
                            <a href="https://sta.smsrm.com/" target="_blank" class="btn-preview"><i class="ph-bold ph-eye"></i> Live Preview</a>
                            <button @click="saveData('sta', staData)" class="btn-save" :disabled="saving">
                                <i class="ph-bold ph-floppy-disk"></i> {{ saving ? 'Menyimpan...' : 'Simpan Perubahan' }}
                            </button>
                        </div>
                    </div>

                    <div v-if="staData">
                        <div class="section-box">
                            <div class="grid-2">
                                <div class="form-group">
                                    <label>Judul Utama</label>
                                    <input v-model="staData.title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Sub Judul</label>
                                    <input v-model="staData.subtitle" type="text" class="form-control">
                                </div>
                                <div class="form-group" style="grid-column: span 2;">
                                    <label>USP Text (Pita Hijau)</label>
                                    <input v-model="staData.uspText" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="section-box" style="border-color: rgba(243, 112, 13, 0.3);">
                            <h3 style="margin-top:0; color:#fff; font-size:1.1rem; margin-bottom:15px;"><i class="ph-fill ph-star" style="color:var(--accent);"></i> Tombol Utama (Paling Atas)</h3>
                            <div class="grid-2">
                                <div class="form-group">
                                    <label>Label Tombol</label>
                                    <input v-model="staData.mainLink.text" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>URL Tujuan</label>
                                    <input v-model="staData.mainLink.url" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; margin-top:30px;">
                            <h3 style="margin:0;">Kategori & Tautan</h3>
                            <button @click="staData.categories.push({label: 'KATEGORI BARU', links: []})" class="btn-add" style="width:auto; margin:0; padding:8px 15px;">
                                <i class="ph-bold ph-plus"></i> Tambah Kategori
                            </button>
                        </div>

                        <div v-for="(cat, cIndex) in staData.categories" :key="cIndex" class="section-box">
                            <div class="section-header">
                                <input v-model="cat.label" type="text" placeholder="Edit Nama Kategori (ex: Kebutuhan Packing)" title="Klik untuk mengedit nama kategori">
                                <button @click="staData.categories.splice(cIndex, 1)" class="btn-icon" title="Hapus Kategori"><i class="ph-bold ph-trash"></i></button>
                            </div>
                            
                            <div v-for="(link, lIndex) in cat.links" :key="lIndex" class="item-row">
                                <div class="form-group">
                                    <label>Label Tautan</label>
                                    <input v-model="link.text" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input v-model="link.url" type="text" class="form-control">
                                </div>
                                <button @click="cat.links.splice(lIndex, 1)" class="btn-icon"><i class="ph-bold ph-x"></i></button>
                            </div>
                            <button @click="cat.links.push({text: '', url: ''})" class="btn-add">
                                <i class="ph-bold ph-plus-circle"></i> Tambah Link
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SMR -->
                <div v-else-if="activeTab === 'smr'">
                    <div class="content-header">
                        <div>
                            <h2>SMR (Info Pusat)</h2>
                            <p>Kelola daftar tautan pusat informasi SIMASRIM dan template tombolnya.</p>
                        </div>
                        <div class="header-actions">
                            <a href="https://smr.smsrm.com/" target="_blank" class="btn-preview"><i class="ph-bold ph-eye"></i> Live Preview</a>
                            <button @click="saveData('smr', smrData)" class="btn-save" :disabled="saving">
                                <i class="ph-bold ph-floppy-disk"></i> {{ saving ? 'Menyimpan...' : 'Simpan Perubahan' }}
                            </button>
                        </div>
                    </div>

                    <div v-if="smrData">
                        <div style="text-align:right; margin-bottom:15px;">
                            <button @click="smrData.links.push({text: 'Tombol Baru', url: '', type: 'standard'})" class="btn-add" style="width:auto; display:inline-flex; margin:0; padding:8px 15px;">
                                <i class="ph-bold ph-plus"></i> Tambah Tombol
                            </button>
                        </div>

                        <div v-for="(link, index) in smrData.links" :key="index" class="item-row grid-3">
                            <div class="form-group">
                                <label>Label Tombol</label>
                                <input v-model="link.text" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>URL Tujuan</label>
                                <input v-model="link.url" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Template Desain</label>
                                <select v-model="link.type" class="form-control" style="appearance:none; background-color: rgba(0,0,0,0.5);">
                                    <option value="standard" style="color:black;">Standard (Tanpa Icon)</option>
                                    <option value="daftar" style="color:black;">Daftar (Icon Panah)</option>
                                    <option value="pembelian" style="color:black;">Pembelian (Icon Keranjang)</option>
                                    <option value="whatsapp" style="color:black;">WhatsApp (Hijau)</option>
                                    <option value="highlight" style="color:black;">Aplikasi (Highlight Ungu)</option>
                                </select>
                            </div>
                            <button @click="smrData.links.splice(index, 1)" class="btn-icon"><i class="ph-bold ph-trash"></i></button>
                        </div>

                        <!-- Social Media SMR -->
                        <div class="section-box" style="margin-top: 30px;">
                            <div class="section-header" style="border:none; padding-bottom:0; margin-bottom:15px;">
                                <h3 style="margin:0; color:#fff; font-size:1.1rem;"><i class="ph-fill ph-share-network" style="color:var(--accent);"></i> Tautan Sosial Media</h3>
                                <button @click="if(!smrData.socials) smrData.socials = []; smrData.socials.push({platform: 'instagram', url: ''})" class="btn-add" style="width:auto; margin:0; padding:8px 15px;">
                                    <i class="ph-bold ph-plus"></i> Tambah Sosmed
                                </button>
                            </div>
                            
                            <div v-if="!smrData.socials || smrData.socials.length === 0" style="color:var(--text-muted); text-align:center; padding:15px;">
                                Belum ada link sosial media.
                            </div>

                            <div v-for="(soc, sIndex) in smrData.socials" :key="sIndex" class="item-row grid-3">
                                <div class="form-group" style="flex:1;">
                                    <label>Platform</label>
                                    <select v-model="soc.platform" class="form-control" style="appearance:none; background-color: rgba(0,0,0,0.5);">
                                        <option value="instagram" style="color:black;">Instagram</option>
                                        <option value="tiktok" style="color:black;">TikTok</option>
                                        <option value="linkedin" style="color:black;">LinkedIn</option>
                                        <option value="youtube" style="color:black;">YouTube</option>
                                        <option value="facebook" style="color:black;">Facebook</option>
                                        <option value="twitter" style="color:black;">X / Twitter</option>
                                        <option value="website" style="color:black;">Website (Globe)</option>
                                    </select>
                                </div>
                                <div class="form-group" style="flex:2; grid-column: span 2;">
                                    <label>URL / Tautan Profil</label>
                                    <div style="display:flex; gap:10px;">
                                        <input v-model="soc.url" type="text" class="form-control" placeholder="https://...">
                                        <button @click="smrData.socials.splice(sIndex, 1)" class="btn-icon"><i class="ph-bold ph-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PORTAL -->
                <div v-else-if="activeTab === 'portal'">
                    <div class="content-header">
                        <div>
                            <h2>Portal Eksekutif</h2>
                            <p>Edit section, ikon, dan tautan di dashboard utama.</p>
                        </div>
                        <div class="header-actions">
                            <a href="https://portal.smsrm.com/" target="_blank" class="btn-preview"><i class="ph-bold ph-eye"></i> Live Preview</a>
                            <button @click="saveData('portal', portalData)" class="btn-save" :disabled="saving">
                                <i class="ph-bold ph-floppy-disk"></i> {{ saving ? 'Menyimpan...' : 'Simpan Perubahan' }}
                            </button>
                        </div>
                    </div>

                    <div v-if="portalData">
                        <div style="display:flex; justify-content:flex-end; margin-bottom:15px;">
                            <button @click="portalData.categories.push({title: 'SECTION BARU', items: []})" class="btn-add" style="width:auto; margin:0; padding:8px 15px;">
                                <i class="ph-bold ph-folder-plus"></i> Tambah Section Baru
                            </button>
                        </div>

                        <div v-for="(cat, cIndex) in portalData.categories" :key="cIndex" class="section-box">
                            <div class="section-header" style="flex-direction:column; align-items:flex-start; gap:10px;">
                                <div style="display:flex; justify-content:space-between; width:100%; align-items:center;">
                                    <input v-model="cat.title" type="text" placeholder="Edit Nama Section (ex: B2B Area)" title="Klik untuk mengedit">
                                    <button @click="portalData.categories.splice(cIndex, 1)" class="btn-icon" style="background:transparent; border:none;" title="Hapus Section"><i class="ph-bold ph-trash"></i></button>
                                </div>
                                <input v-model="cat.subtitle" type="text" placeholder="(Opsional) Subtitle Deskripsi" style="font-size:0.9rem; font-weight:normal; color:var(--text-muted); width:100%;">
                            </div>
                            
                            <div class="grid-2">
                                <div v-for="(item, iIndex) in cat.items" :key="iIndex" style="background:rgba(0,0,0,0.3); border:1px solid rgba(255,255,255,0.05); border-radius:12px; padding:15px; position:relative;">
                                    <button @click="cat.items.splice(iIndex, 1)" class="btn-icon" style="position:absolute; top:10px; right:10px; width:30px; height:30px; background:transparent; border:none;"><i class="ph-bold ph-x-circle text-lg"></i></button>
                                    
                                    <div class="form-group">
                                        <label>URL Tujuan</label>
                                        <input v-model="item.url" type="text" class="form-control">
                                    </div>
                                    <div class="grid-2">
                                        <div class="form-group">
                                            <label>Icon / Teks</label>
                                            <input v-model="item.icon" type="text" class="form-control" placeholder="ph-link">
                                        </div>
                                        <div class="form-group" style="display:flex; align-items:flex-end; padding-bottom:10px;">
                                            <label class="checkbox-label">
                                                <input type="checkbox" v-model="item.isRegionCode"> Teks Singkatan (bukan Ikon)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div class="form-group">
                                            <label>Tooltip Judul</label>
                                            <input v-model="item.tooltipTitle" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Tooltip Deskripsi</label>
                                            <input v-model="item.tooltipDesc" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div class="form-group">
                                            <label>ID/User (Opsional)</label>
                                            <input v-model="item.tooltipId" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Password (Opsional)</label>
                                            <input v-model="item.tooltipPw" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div @click="cat.items.push({url: '', icon: 'ph-link', isRegionCode: false, tooltipTitle: 'Judul Baru', tooltipDesc: ''})" style="border: 2px dashed rgba(255,255,255,0.2); border-radius: 12px; display:flex; flex-direction:column; align-items:center; justify-content:center; color:var(--text-muted); cursor:pointer; min-height:150px; transition:all 0.3s;" onmouseover="this.style.borderColor='var(--accent)'; this.style.color='white'" onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'; this.style.color='var(--text-muted)'">
                                    <i class="ph-bold ph-plus-circle" style="font-size:2rem; margin-bottom:10px;"></i>
                                    <span>Tambah Card</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="toast" :class="[toastType, {show: toastMessage}]">
            <i class="ph-fill" :class="toastType === 'success' ? 'ph-check-circle' : 'ph-warning-circle'"></i>
            <span>{{ toastMessage }}</span>
        </div>

    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    activeTab: 'sta',
                    loading: true,
                    saving: false,
                    toastMessage: '',
                    toastType: 'success',
                    staData: null,
                    smrData: null,
                    portalData: null
                }
            },
            mounted() {
                this.loadAllData();
            },
            methods: {
                async loadAllData() {
                    // PORTOFOLIO DEMO: versi asli fetch langsung ke Firebase RTDB dulu,
                    // baru fallback ke file lokal. Di versi porto, panggilan live
                    // DIHILANGKAN TOTAL — selalu baca dari file JSON dummy lokal.
                    this.loading = true;
                    try {
                        const [localSta, localSmr, localPortal] = await Promise.all([
                            fetch('data/sta_data.json?t=' + Date.now()),
                            fetch('data/smr_data.json?t=' + Date.now()),
                            fetch('data/portal_data.json?t=' + Date.now())
                        ]);

                        this.staData = await localSta.json();
                        this.smrData = await localSmr.json();
                        this.portalData = await localPortal.json();
                    } catch (err) {
                        console.error('Error loading JSON data', err);
                        this.showToast('Gagal memuat data dari server', 'error');
                    }
                    this.loading = false;
                },
                async saveData(target, data) {
                    this.saving = true;
                    try {
                        const response = await fetch(`api_save.php?target=${target}`, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(data)
                        });
                        const result = await response.json();
                        if(result.status === 'success') {
                            this.showToast('Data berhasil disimpan!', 'success');
                        } else {
                            this.showToast(result.message || 'Gagal menyimpan', 'error');
                        }
                    } catch (err) {
                        this.showToast('Koneksi terputus saat menyimpan', 'error');
                    }
                    this.saving = false;
                },
                showToast(msg, type) {
                    this.toastMessage = msg;
                    this.toastType = type;
                    setTimeout(() => {
                        this.toastMessage = '';
                    }, 3000);
                }
            }
        }).mount('#app');
    </script>
    <style>
        [v-cloak] { display: none; }
    </style>
</body>
</html>
