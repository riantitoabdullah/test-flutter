<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./Assets/css/style2.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h2>Dashboard</h2>
      </div>
      <div class="card-body">
        <form id="postForm">
          <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="body" class="form-label">Body:</label>
            <textarea id="body" name="body" class="form-control" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
      </div>
    </div>

    <div class="table-container">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Body</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="posts"></tbody>
      </table>
    </div>
  </div>
  <script>
    const API_URL = 'https://jsonplaceholder.typicode.com/posts';
    let state = {
      posts: [],
      editingPost: null
    };

    document.getElementById('postForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const title = document.getElementById('title').value;
      const body = document.getElementById('body').value;

      if (state.editingPost) {
        updatePost(state.editingPost.id, {
          title,
          body
        });
      } else {
        createPost({
          title,
          body
        });
      }

      document.getElementById('postForm').reset();
    });

    async function fetchPosts() {
      try {
        const response = await fetch(API_URL);
        const posts = await response.json();
        updateState({
          posts
        });
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
    }

    function renderPosts(posts) {
      const postsContainer = document.getElementById('posts');
      postsContainer.innerHTML = '';
      posts.forEach(post => {
        const postElement = document.createElement('tr');
        postElement.innerHTML = `
          <td>${post.title}</td>
          <td>${post.body}</td>
          <td>
            <button class="btn btn-info btn-sm" onclick="editPost(${post.id})">Edit</button>
            <button class="btn btn-danger btn-sm" onclick="deletePost(${post.id})">Delete</button>
          </td>
        `;
        postsContainer.appendChild(postElement);
      });
    }

    async function createPost(post) {
      try {
        const response = await fetch(API_URL, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(post)
        });
        const newPost = await response.json();
        updateState({
          posts: [newPost, ...state.posts]
        });
        alert('Post created successfully!');
      } catch (error) {
        console.error('Error creating post:', error);
      }
    }

    async function updatePost(id, updatedPost) {
      try {
        const response = await fetch(`${API_URL}/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(updatedPost)
        });
        const newPost = await response.json();
        const updatedPosts = state.posts.map(post =>
          post.id === id ? newPost : post
        );
        updateState({
          posts: updatedPosts,
          editingPost: null
        });
        alert('Post updated successfully!');
      } catch (error) {
        console.error('Error updating post:', error);
      }
    }

    async function deletePost(id) {
      try {
        await fetch(`${API_URL}/${id}`, {
          method: 'DELETE',
        });
        const updatedPosts = state.posts.filter(post => post.id !== id);
        updateState({
          posts: updatedPosts
        });
        alert('Post deleted successfully!');
      } catch (error) {
        console.error('Error deleting post:', error);
      }
    }

    function editPost(id) {
      const post = state.posts.find(post => post.id === id);
      document.getElementById('title').value = post.title;
      document.getElementById('body').value = post.body;
      updateState({
        editingPost: post
      });
    }

    function updateState(newState) {
      state = {
        ...state,
        ...newState
      };
      renderPosts(state.posts);
    }

    window.onload = fetchPosts;
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>