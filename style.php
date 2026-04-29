* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html,
body {
    height: 100%;
}

body {
    background-color: #dcc9a9;
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    color: #4d4433;
    line-height: 1.6;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 45px;
    background-color: #dcc9a9;
}

.logo a {
    text-decoration: none;
    font-size: 48px;
    font-family: Georgia, serif;
    font-weight: bold;
    color: #9f8d1e;
}

.btn-header {
    background-color: #9f8d1e;
    color: white;
    text-decoration: none;
    padding: 14px 28px;
    border-radius: 8px;
    display: inline-block;
}

.btn-header:hover {
    background-color: #8b7a18;
}

.navbar {
    background-color: #9f8d1e;
    margin: 0 30px;
    padding: 22px 20px;
    display: flex;
    justify-content: space-around;
    border-radius: 10px;
}

.navbar a {
    color: white;
    text-decoration: none;
    font-size: 18px;
}

.navbar a:hover {
    text-decoration: underline;
}

.main-content {
    background-color: white;
    margin: 20px 30px;
    padding: 40px;
    flex: 1;
    border-radius: 10px;
}

.welcome-box {
    background-color: #f8f5ef;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
}

.welcome-box h1 {
    color: #8c7a1a;
    font-size: 34px;
    margin-bottom: 15px;
}

.welcome-box p {
    font-size: 18px;
}

.cards-section {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background-color: #f8f5ef;
    border-radius: 15px;
    padding: 25px;
    flex: 1;
}

.card h2 {
    color: #8c7a1a;
    font-size: 22px;
    margin-bottom: 10px;
}

.card p {
    font-size: 16px;
}

.quote-box {
    background-color: #f3ecdf;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    text-align: center;
}

.quote-box p {
    font-style: italic;
    font-size: 24px;
    color: #8c7a1a;
}

.highlight-box {
    background-color: #f8f5ef;
    border-radius: 15px;
    padding: 30px;
    display: flex;
    gap: 30px;
    margin-bottom: 30px;
}

.highlight-text {
    flex: 2;
}

.highlight-text h2 {
    color: #8c7a1a;
    font-size: 32px;
    margin-bottom: 15px;
}

.highlight-text p {
    font-size: 18px;
}

.highlight-side {
    flex: 1;
    background-color: white;
    border-radius: 12px;
    padding: 20px;
}

.highlight-side h3 {
    color: #8c7a1a;
    margin-bottom: 15px;
    font-size: 24px;
}

.highlight-side p {
    margin-bottom: 10px;
    font-size: 18px;
}

.footer {
    background-color: #9f8d1e;
    padding: 25px;
    display: flex;
    justify-content: center;
    gap: 30px;
}

.footer a {
    color: white;
    text-decoration: none;
    font-size: 16px;
}

.footer a:hover {
    text-decoration: underline;
}

// Forum Page Styles

.forum-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    background-color: #f8f5ef;
    border-radius: 12px;
    padding: 20px 25px;
}

.forum-category {
    font-size: 18px;
    font-weight: bold;
    color: #8c7a1a;
}

.forum-button {
    background-color: #9f8d1e;
    color: white;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.forum-button:hover {
    background-color: #8b7a18;
}

.forum-list {
    margin-bottom: 30px;
}

.forum-topic {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    background-color: #f8f5ef;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 15px;
}

.forum-topic-full {
    margin-bottom: 0;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.forum-topic-left {
    flex: 3;
}

.forum-topic-left h2 {
    color: #8c7a1a;
    font-size: 24px;
    margin-bottom: 8px;
}

.forum-meta {
    font-size: 14px;
    color: #7a715f;
    margin-bottom: 10px;
}

.forum-topic-right {
    flex: 1;
    text-align: right;
    font-size: 16px;
    color: #4d4433;
}

.comments-box {
    background-color: #fcfaf5;
    border-radius: 0 0 12px 12px;
    padding: 20px 25px;
    margin-bottom: 25px;
    border-top: 1px solid #e6dccb;
}

.comments-box h3 {
    color: #8c7a1a;
    margin-bottom: 15px;
}

.comment-item {
    background-color: white;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 12px;
}

.comment-meta {
    font-size: 14px;
    color: #7a715f;
    margin-bottom: 8px;
}

.no-comment {
    margin-bottom: 15px;
    color: #7a715f;
}

.comment-form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.comment-form label {
    color: #8c7a1a;
    font-weight: bold;
}

.comment-form select,
.comment-form textarea {
    padding: 12px;
    border: 1px solid #d8ccb0;
    border-radius: 8px;
    font-family: Arial, sans-serif;
    font-size: 15px;
}

// Vente 

.sale-toolbar {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.sale-filter {
    background-color: #f8f5ef;
    color: #8c7a1a;
    padding: 12px 18px;
    border-radius: 10px;
    font-weight: bold;
}

.sale-grid {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.sale-card {
    background-color: #f8f5ef;
    border-radius: 15px;
    padding: 20px;
    flex: 1;
}

.sale-cover {
    background-color: #e8dfd1;
    color: #8c7a1a;
    height: 180px;
    border-radius: 10px;
    margin-bottom: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}

.sale-card h2 {
    color: #8c7a1a;
    font-size: 22px;
    margin-bottom: 10px;
}

.sale-author,
.sale-price {
    margin-bottom: 8px;
    font-size: 16px;
}

.sale-price {
    font-weight: bold;
}

.sale-description {
    margin-bottom: 15px;
}

.sale-info {
    background-color: white;
    border-radius: 10px;
    padding: 12px;
}

.sale-info p {
    margin-bottom: 6px;
    font-size: 15px;
}

.sale-info p:last-child {
    margin-bottom: 0;
}