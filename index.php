<?php 
  session_start(); 
  require_once('./database/requete.php');

  if(isset($_SESSION['admin'])) {
    $id = $_SESSION['admin']['id'];
  } elseif(isset($_SESSION['user'])) {
    $id = $_SESSION['user']['id'];
  }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunGame v2</title>
    <style type="text/tailwindcss">
        @layer utilities {
          .content-auto {
            content-visibility: auto;
          }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM3cxh5TWAoaDyR37ZjxZ6w5e7q2Jvp4k0bslQ" crossorigin="anonymous">

</head>
<body>
    <?php require_once('includes/navbar.php') ?>

    <div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="./asset/images/Kingdom Hearts III- jeux.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://lh6.googleusercontent.com/proxy/k2Cqd4aWed7GQgrAcKXKNYKFjODU6EkmaWAMR2hn4b7DYi6WjgZMy1XgMbHFmBecr2uG73YIO21bmxVf48dsdCIHMVlf7IJO9KKQdVTmwjNMvsmcEY_ZDNVPmJfCBkGkt9RXchsr9N7hawzo25JiJXiJu066-e4QGsnpLZUjUW_cccUzElOU0WBnGSbNpfBEOA" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://i.pinimg.com/originals/e4/29/41/e429410579ad13007bf15edabb3d44c9.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBPSmS51mU6kianEAvRsead5XvlE5ioYQ71A&s" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://www.fond-ecran-hd.net/Public/uploads/2020-07-10/thumbs-1/wallpapertitanfall2videogames.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<div class="section trending py-10 bg-gray-100">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php
        $jeux = displayGame();
        if ($jeux->rowCount() > 0) {
          // Afficher les jeux avec les détails de l'éditeur, du genre et du prix
          while($row = $jeux->fetch(PDO::FETCH_ASSOC)) {
            if(isset($id)){
              $InWishlist = InWishlist($id,$row['JeuxID']);
            }
              echo '<div class="trending-items bg-white shadow-md rounded-lg overflow-hidden transition-all transform hover:-translate-y-1 hover:shadow-lg">';
              echo '<div class="thumb">';
              echo '<a href="product-details.php?id='.$row['JeuxID'].'">';
              echo '<img class="w-full h-48 object-cover" src="asset/images/'.$row['Image'].'" alt="">';
              echo '</a>';
              echo '<span class="price absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-bold">'.$row['Tarif'].'€</span>';
              echo '</div>';
              echo '<div class="p-4">';
              echo '<span class="category text-sm text-gray-500">'.$row['Genre'].'</span>';
              echo '<h4 class="text-lg font-semibold mt-2 mb-4">'.$row['Titre'].'</h4>';
              if(isset($id)){
                if($InWishlist){
                  echo '<a href="#" class="remove-wishlist text-red-500" data-jeuxid="' . $row['JeuxID'] . '">';
                  echo '<i class="fa-solid fa-heart"></i>';
                  echo '</a>';
                } else {
                  echo '<a href="#" class="add-wishlist text-gray-600 hover:text-green-500" data-jeuxid="' . $row['JeuxID'] . '">';
                  echo '<i class="fa fa-shopping-bag"></i>';
                  echo '</a>';
                }
              } else {
                echo '<a href="profil/logIn.php" class="text-gray-600 hover:text-green-500">';
                echo '<i class="fa fa-shopping-bag"></i>';
                echo '</a>';
              }
              echo '</div>';
              echo '</div>';
          }
          } else {
              echo "0 résultats";
          }
          $connexion = null;
        ?>
    </div>
  </div>
</div>

<?php require_once('./includes/footer.php') ?>    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/2ac531f13a.js" crossorigin="anonymous"></script>
</body>
</html>