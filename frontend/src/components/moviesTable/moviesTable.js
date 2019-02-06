import React from 'react'

import MoviesTableCss from './moviesTable.css'

class MoviesTable extends React.Component{


  render(){
    return (
			<div className="container moviesTable col-xs-12">
				<table className="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Titulo</th>
							<th scope="col">Descrição</th>
							<th scope="col">Categoria</th>
							<th scope="col">Ator</th>
							<th scope="col">Diretor</th>
							<th scope="col">Imagens</th>
							<th scope="col">Ações</th>
						</tr>
					</thead>
					<tbody>
						{
              this.props.movies ?
              this.props.movies.map(movie => (
							<tr key={movie.id}>
								<th scope="row">{movie.id}</th>
								<td>{movie.titulo}</td>
								<td>{movie.descricao}</td>
								<td>{movie.categoria}</td>
								<td>{movie.ator}</td>
								<td>{movie.diretor}</td>
								<td>{movie.imagem}</td>
								<td>
									<button onClick={() => this.props.handleDelete(movie.id)} className="btn btn-sm btn-danger">
										<i className="far fa-trash-alt" />
									</button>
                  <button onClick={() => this.props.handleEdit(movie)} className="btn btn-sm btn-primary btn-edit">
                    <i className="fas fa-pencil-alt" />
                  </button>
								</td>
							</tr>
            ))
          : ''}
					</tbody>
				</table>
			</div>
		);
  }
}


export default MoviesTable;