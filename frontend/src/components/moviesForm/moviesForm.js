import React from 'react'

import './moviesStyle.css'

export default props => (
  <div className="col-xs-12 col-sm-12 col-md-6 container form">
    <div className="form-group">
      <label>Titulo</label>
      <input type="text" className="form-control" value={props.formData.titulo} onChange={props.handleChange} id="titulo"  placeholder="Digite o titulo"/>
    </div>

    <div className="form-group">
      <label>Descrição</label>
      <input type="text"  className="form-control" value={props.formData.descricao} onChange={props.handleChange} id="descricao"  placeholder="Digite a descrição"/>
    </div>

    <div className="form-group">
      <label>Categoria</label>
      <input type="text" className="form-control" value={props.formData.categoria} onChange={props.handleChange} id="categoria"  placeholder="Digite a categoria"/>
    </div>

    <div className="form-group">
      <label>Ator</label>
      <input type="text" className="form-control" value={props.formData.ator} onChange={props.handleChange} id="ator"  placeholder="Digite o ator"/>
    </div>

    <div className="form-group">
      <label>Diretor</label>
      <input type="text" className="form-control" value={props.formData.diretor} onChange={props.handleChange} id="diretor"  placeholder="Digite o diretor"/>
    </div>

    <div className="form-group">
      <label>Imagens</label>
      <input type="text" className="form-control" value={props.formData.imagem} onChange={props.handleChange} id="imagem"  placeholder="Digite a imagem"/>
    </div>
  
  <button type="submit" onClick={() => props.handleSubmit()} className="btn btn-primary">Cadastrar</button>
  </div>
)