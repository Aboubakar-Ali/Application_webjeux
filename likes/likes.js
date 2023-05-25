// document.querySelectorAll('.like-button').forEach(function(button) {
//     button.addEventListener('click', function() {
//         var articleId = this.getAttribute('data-article-id');

//         // Envoyer une requête AJAX au serveur pour "liker" l'article
//         var xhr = new XMLHttpRequest();
//         xhr.open('POST', 'like_article.php', true);
//         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//         xhr.send('article_id=' + articleId);

//         xhr.onload = function() {
//             if (xhr.status === 200) {
//                 // Mise à jour de l'interface utilisateur pour montrer que l'article a été "liké"
//                 button.textContent = 'Liked';
//             }
//         };
//     });
// });
