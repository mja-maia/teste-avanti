import React from 'react'
import NavBar from './components/navbar/navbar'
import MoviesTable from './components/moviesTable/moviesTable'
import MoviesForm from './components/moviesForm/moviesForm'
import {
  BrowserRouter,
  Switch,
  Route
} from 'react-router-dom'

import axios from 'axios';


class App extends React.Component{


  constructor(props){
    super(props)
    this.state = {
      movies: [],
      showForm: false,
      formData: {
        id: null,
        titulo: '',
        descricao: '',
        categoria: '',
        ator: '',
        diretor: '',
        imagem: ''
      }
    }

    this.fetchData();
    this.handleDelete = this.handleDelete.bind(this)
    this.handleChange = this.handleChange.bind(this)
    this.handleShowForm = this.handleShowForm.bind(this)
    this.handleSubmit = this.handleSubmit.bind(this)
    this.handleEdit = this.handleEdit.bind(this)
  }

  async fetchData() {
    await axios
      .get("http://localhost:8082/api/movies/read.php")
      .then(resp => {
        this.setState({
          ...this.state,
          movies: resp.data.data
        });
      });
  }

  async createMovie() {
    await axios
      .post("http://localhost:8082/api/movies/create.php", JSON.stringify(this.state.formData))
      .then(() => {
        this.fetchData()
        this.handleShowForm()
      });
  }

  async updateMovie() {
    await axios
      .post("http://localhost:8082/api/movies/update.php", JSON.stringify(this.state.formData))
      .then(() => {
        this.fetchData()
        this.setState({
          ...this.state,
          showForm: false
        })
      });
  }

  async handleDelete(id) {
    await axios
      .post("http://localhost:8082/api/movies/delete.php", {
        "id": id
      })
      .then(() => {
        this.fetchData()
      });
  }

  handleChange(event){
    this.setState({
      ...this.state,
      formData:{
        ...this.state.formData,
        [event.target.id]: event.target.value
      }
    })
  }

  handleShowForm() {
    this.setState({
      ...this.state,
      showForm: !this.state.showForm
    })
  }

  handleSubmit(){
    if(this.state.formData.id !== null){
      this.updateMovie();
    }else{
      this.createMovie();
    }
  }

  handleEdit(movie){
    this.setState({
      ...this.state,
      formData: {
        ...this.state.formData,
        id: movie.id,
        titulo: movie.titulo,
        descricao: movie.descricao,
        categoria: movie.categoria,
        ator: movie.ator,
        diretor: movie.diretor,
        imagem: movie.imagem
      },
      showForm: true
    })
  }


  render(){
    return (
      <div>
        < NavBar 
          handleShowForm={this.handleShowForm}/ >
          {
            this.state.showForm &&
            <MoviesForm 
            formData={this.state.formData} 
            handleChange={this.handleChange} 
            handleSubmit={this.handleSubmit}/>
          }
          <BrowserRouter>
            <Switch>
              <Route exact path="/" component={() => 
              <MoviesTable 
                handleDelete={ this.handleDelete } 
                handleEdit={this.handleEdit}
                movies={this.state.movies}/>} list="miguel"
              />
              <Route path="/*" component={MoviesTable}/>
            </Switch>
          </BrowserRouter>
      </div>
    )
  }
}

export default App;