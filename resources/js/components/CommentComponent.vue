<template>
<div class="container">
    <h1>Los Palmares Palapa Menu Beta Test Comments</h1>
    <form @submit.prevent="addComment" method="post">
        <div class="comment">
            <textarea name="comment" v-model="comment.comment" placeholder="Your Comment"></textarea>
        </div>
        <div class="initials">
            <input type="text" name="initials" v-model="comment.initials" placeholder="Your Initials">
        </div>
        <div class="button">
            <button type="submit" class="btn btn-success">Add Comment</button>
        </div>
    </form>
    <div class="comments" v-for="(comment, idx) in comments" v-bind:key='idx'>
        <span class="comment" v-bind:class="{ fixed: comment.fixed==true }">{{comment.comment}}</span>
        <span class="initials">{{comment.initials}}</span>
        <span class="action"><button v-show='comment.fixed==false' @click="markFixed(comment.id)" class="btn btn-info">Fixed</button></span>
    </div>
  </div>
</template>

<script>

export default {
  data () {
    return {
        comments:[],
        comment: {
            id:'',
            comment:'',
            initials:''
        },
    }
  },
  methods: {
      addComment() {
          if (this.comment.comment == '') {
              alert('Comment cannot be blank');
              return;
          }
          if (this.comment.initials == '') {
              alert('Initials cannot be blank');
              return;
          }
        fetch('api/comment', {
            method:'post',
            body: JSON.stringify(this.comment),
            headers: {
                'content-type': 'application/json'
            }
        })
        .then (res=> res.json)
        .then(data => {
            this.comment.comment = '';
            this.comment.initials = '';
            this.fetchComments();
        })
        .catch(err=> console.log(err));
      },
      markFixed(id, fixed) {
          fetch('api/comment/'+id, {
              method: "put",
              body: JSON.stringify({"fixed":true}),
              headers: {
                  'content-type': 'application/json'
              }
          })
            .then(res=>res.json)
            .then(()=> {
                this.fetchComments();
              })
              .catch(err=> console.log(err));
      },
      fetchComments() {
          fetch('api/comments')
          .then(res=>res.json())
          .then(res=>{
              this.comments = res
          });
      }
  },
  created() {
      this.fetchComments();
  },
}
</script>

<style scoped>
    .container {
        font-family: Arial, Helvetica, sans-serif;
    }
    .comments {
        display:flex;
        justify-content: flex-start;
        margin-left:10px;
    }
    h1 {
        color:#083a58;
        margin-top:10px;
        margin-bottom:10px;
        }
    form {
        display:flex;
        height:150px;
        justify-content: space-between;
        flex-wrap:wrap;
        height:180px;
    }
    .comment {
        flex-grow:4;
        flex-basis:75%;
    }
    .comment textarea {
        width:95%;
        height:100px;
    }
    .initials {
        flex-basis:10%;
    }
    .button {
        flex-basis:100%;
    }
    .action {
        flex-basis:15%;
        margin-left:25px;
    }
    .fixed {
        text-decoration: line-through;
    }

.btn {
	background: #083a58;
    background-image: linear-gradient(to bottom, #083a58, #0d4c74);
    border-radius: 5px;
    /* box-shadow: 1px 1px 6px #666666; */
    color: #fafafa;
    font-size: 15px;
    padding: 4px 15px;
    text-decoration: none;
    border-color:#fafafa;
}
.btn:hover {
  background: #2079b0;
  background-image: linear-gradient(to bottom, #0d4c74, #083a58);
  text-decoration: none;
}
</style>