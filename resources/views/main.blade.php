<!DOCTYPE html>
<html lang="en">

@include('include.head')

</head>

<body class="index-page">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<header id="header" class="header d-flex flex-column justify-content-center">

    <i class="header-toggle d-xl-none bi bi-list"></i>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="/" class="active"><i class="bi bi-house navicon"></i><span>Anasayfa</span></a></li>
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#konumModal">
                    <i class="bi bi-pin-fill"></i><span>Konum Ekle</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="toggleKonumPanel(event)">
                    <i class="bi bi-card-list"></i><span>Konum Listele</span>
                </a>
            </li>
        </ul>
    </nav>

</header>


<div class="modal fade" id="konumModal" tabindex="-1" aria-labelledby="konumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="konumModalLabel">Konum Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <form id="konumForm" method="POST" action="{{ route('konum.ekle') }}">
                    @csrf
                <div class="mb-3">
                        <label for="konumAdi" class="form-label">Konum Adı</label>
                        <input type="text" class="form-control" id="konumAdi" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Enlem (Latitude)</label>
                        <input type="number" class="form-control" id="latitude" name="latitude" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Boylam (Longitude)</label>
                        <input type="number" class="form-control" id="longitude" name="longitude" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Marker Rengi</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color" value="#ff0000" title="Renk seçin">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                <button type="submit" form="konumForm" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>

<div id="konumListesiPanel" style="
    position: fixed;
    top: 0;
    right: -300px;
    width: 300px;
    height: 100%;
    background: #fff;
    border-left: 1px solid #ccc;
    transition: right 0.3s ease-in-out;
    padding: 20px;
        z-index: 1050;
            overflow-y: auto;
">
    <h5>Konum Listesi</h5>
    <div id="konumListesiIcerik">
    </div>
</div>



<main class="main">


    <section>


    </section>


</main>



<div id="preloader"></div>

<script src="{{ asset('js/main.js') }}"></script>
<script>
    function toggleKonumPanel(e) {
        e.preventDefault();
        const panel = document.getElementById("konumListesiPanel");
        if (panel.style.right === "0px") {
            panel.style.left = "-300px";
            return;
        }

        panel.style.right = "0px";

        fetch('/konumlar')
            .then(res => res.json())
            .then(data => {
                const icerikDiv = document.getElementById("konumListesiIcerik");
                icerikDiv.innerHTML = '';

                data.forEach(loc => {
                    icerikDiv.innerHTML += `
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px; position:relative;">
            <strong>${loc.name}</strong><br>
            Enlem: ${loc.latitude}<br>
            Boylam: ${loc.longitude}<br>
            Renk: <span style="color:${loc.color}">${loc.color}</span>

            <button onclick="openEditForm(${loc.id}, '${loc.name}', ${loc.latitude}, ${loc.longitude}, '${loc.color}')"
                style="position:absolute; top:10px; right:10px; border:none; background:none;">
                <i class="bi bi-pencil-square"></i>
            </button>
        </div>
    `;
                });

            });
    }
</script>


<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="/konum-guncelle" id="editForm" class="modal-content">
            @csrf
            @method('POST')
            <input type="hidden" name="id" id="edit_id">

            <div class="modal-header">
                <h5 class="modal-title">Konumu Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Ad</label>
                    <input type="text" class="form-control" name="name" id="edit_name" required>
                </div>
                <div class="mb-3">
                    <label>Enlem</label>
                    <input type="number" class="form-control" name="latitude" id="edit_latitude" step="any" required>
                </div>
                <div class="mb-3">
                    <label>Boylam</label>
                    <input type="number" class="form-control" name="longitude" id="edit_longitude" step="any" required>
                </div>
                <div class="mb-3">
                    <label>Renk</label>
                    <input type="color" class="form-control" name="color" id="edit_color" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditForm(id, name, lat, lng, color) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_latitude').value = lat;
        document.getElementById('edit_longitude').value = lng;
        document.getElementById('edit_color').value = color;

        const modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }

</script>


</body>

</html>
