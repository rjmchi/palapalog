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
      <table>
          <tr width="90%" v-for="(comment, idx) in comments" v-bind:key='idx'>
              <td v-bind:class="{ fixed: comment.fixed==true }" width="75%">{{comment.comment}}</td>
              <td width="10%">{{comment.initials}}</td>
              <td><button v-show='comment.fixed==false' @click="markFixed(comment.id)" class="btn btn-info">Fixed</button></td>
          </tr>
          </table>
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
        .catch(err=> console.log('error'));
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
              .catch(err=> console.log('ererror2r'));
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

<style lang="scss" scoped>
    h1 {
        color:purple;
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
        textarea {
            width:95%;
            height:100px;
        };
    }
    .initials {
        flex-basis:25px;
    }
    .button {
        flex-basis:100%;
    }
    table {
        margin-top:25px;
    }
    .fixed {
        text-decoration: line-through;
    }
</style>