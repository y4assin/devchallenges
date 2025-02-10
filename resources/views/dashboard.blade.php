<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
<div class="container py-5 position-relative">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout-button">
        @csrf
        <button type="submit" class="btn btn-danger">🚪 Sortir Sessió</button>
    </form>
        
        <h1 class="text-center mb-5">🚀 Dashboard</h1>
        <div class="row g-4">
            <!-- Portafolio -->
            <div class="col-md-4">
                <div class="card dashboard-card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title">🎨 El meu Portfoli</h4>
                        <p class="card-text">Projectes i molt més</p>
                        <a href="https://portfolio.yassineelbakali.com" class="btn btn-light text-primary">Ir al Portafolio</a>
                    </div>
                </div>
            </div>
            
            <!-- Lista de la compra -->
            <div class="col-md-4">
                <div class="card dashboard-card text-white bg-success">
                    <div class="card-body">
                        <h4 class="card-title">🛒 Llista de la Compra</h4>
                        <p class="card-text">Gestiona i comparteix la teva compra.</p>
                        <a href="/shopping-lists" class="btn btn-light text-success">Veure Llistas</a>
                    </div>
                </div>
            </div>

            <!-- Configuración -->
            <div class="col-md-4">
                <div class="card dashboard-card text-white bg-danger">
                    <div class="card-body">
                        <h4 class="card-title">🃏 Joc Cartes</h4>
                        <p class="card-text">Jugar el joc de Carta més alta.</p>
                        <a href="/profile" class="btn btn-light text-black">Anar al Joc</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
