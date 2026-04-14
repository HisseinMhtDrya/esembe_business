<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>RudLess Business</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      a{
        text-decoration: none;
      }
    </style>
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Commande</h2>
      <p class="lead">
        Passer une commande en toute facilité. Livraison rapide et fiable
      </p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Votre panier</span>
          <span class="badge bg-primary rounded-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Nom du produit</h6>
              <small class="text-muted">Brève description</small>
            </div>
            <span class="text-muted">$12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Second produit</h6>
              <small class="text-muted">Brève description</small>
            </div>
            <span class="text-muted">$8</span>
          </li>
          
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Code promotionnel</h6>
              <small>6568a3gf</small>
            </div>
            <span class="text-success">−$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>$20</strong>
          </li>
        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Code promotionnel">
            <button type="submit" class="btn btn-secondary">Racheter</button>
          </div>
        </form>
      </div>
      <div class="col-md-7 col-lg-8">
      
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="form-control" name="nom" id="nom" placeholder="" value="" required>
              <div class="invalid-feedback">
                Nom invalide
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Postnom</label>
              <input type="text" class="form-control" name="postnom" id="postnom" placeholder="" value="" required>
              <div class="invalid-feedback">
                Postnom invalide
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Prenom</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="" required>
              <div class="invalid-feedback">
                  Prenom invalide
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" name="mail" id="email" placeholder="">
              <div class="invalid-feedback">
                Adresse mail non valide
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Adresse</label>
              <input type="text" class="form-control" id="adresse" name="adresse" placeholder="" required>
              <div class="invalid-feedback">
                Veuillez saisir votre adresse de livraison
              </div>
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Pays</label>
              <select class="form-select" id="country" required>
                <option value="">Choisir...</option>
                <option>RDC</option>
              </select>
              <div class="invalid-feedback">
                Pays invalide
              </div>
            </div>

            
          </div>

          <hr class="my-4">

          
          <hr class="my-4">

          <h4 class="mb-3">Moyen de paiement</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Carte crédit</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">M-pesa</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Orange Money</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Airtel Money</label>
            </div>
          </div>

          <div class="row gy-3">
            

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Montant</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Montant exigé
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" name="expiration" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Veuillez entrer une date d'expiration
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                 Code de sécurité
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Continuer</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; <a href="https://rudless.com">RudLess Business</a></p>
    <p><script>document.write(new Date().getFullYear())</script></p>
  </footer>
</div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
