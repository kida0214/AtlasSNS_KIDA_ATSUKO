$(function () {
  // アコーディオン
  $(".js-accordion-title").on("click", function () {
    $(this).next().slideToggle(300);
    $(this).toggleClass("open");
  });


  // 削除モーダル用
  let deleteForm;

  $(".delete-icon").on("click", function (e) {
    e.preventDefault();
    // 削除対象の投稿IDを取得
    const postId = $(this).data("id"); // data-id属性に投稿IDを格納

    // 削除フォームのactionを設定
    deleteForm = $("#deleteForm");
    deleteForm.attr("action", "/posts/" + postId);

    // モーダルを表示
    $("#deleteModal").fadeIn();
  });

  $("#confirmDelete").on("click", function () {
    if (deleteForm) {
      deleteForm.submit();
    }
    $("#deleteModal").fadeOut();
  });

  $("#cancelDelete").on("click", function () {
    $("#deleteModal").fadeOut();
  });


  // 編集モーダル用
  $(".edit-btn").on("click", function (e) {
    e.preventDefault();
    const postId = $(this).data("id");
    const content = $(this).data("content");

    $("#editPostContent").val(content);
    $("#editPostForm").attr("action", `/posts/${postId}`);
    $("#editModal").css("display", "flex");
  });
});
