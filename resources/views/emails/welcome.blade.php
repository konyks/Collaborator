<!DOCTYPE html>
<html>
    <body>
        <div align="center">
            <a class="navbar-brand" href="{{ route('home')}}"><img src="{{ asset('img/group_project.png') }}" class="img-rounded" id="project-logo" alt="Collaborator" width="250" height="100"></a>
        </div>
        <hr>
        <h1>Hi, {{$name}}</h1>
        <h1 align="center">WELCOME TO COLLABORATOR</h1>
        <h3 align="center">Place where you can find a best fitting study group in variety of subjects.</h3>
        <hr>
        <div align="center">
            <a class="navbar-brand" href="{{ route('home')}}"><img src="{{ asset('img/group_logo.png') }}" class="img-rounded" id="team-logo" alt="KPHSystems" width="150" height="100"></a>
        </div>
    </body>
</html>