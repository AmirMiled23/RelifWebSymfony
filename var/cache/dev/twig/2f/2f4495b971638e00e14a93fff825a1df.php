<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* homepage.html.twig */
class __TwigTemplate_2e231bdbda01e2e3bf4aa304c3a314f2 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'body' => [$this, 'block_body'],
            'js' => [$this, 'block_js'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "homepage.html.twig"));

        // line 1
        yield "
<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <title>";
        // line 7
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
  ";
        // line 8
        yield from $this->unwrap()->yieldBlock('css', $context, $blocks);
        // line 15
        yield "</head>

<body>
  <!-- Sub Header -->
  <div class=\"sub-header\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-8\">
          <ul class=\"left-info\">
            <li><a href=\"#\"><i class=\"fa fa-clock-o\"></i>Mon - Fri 09:00-17:00</a></li>
            <li><a href=\"#\"><i class=\"fa fa-phone\"></i>010-020-0340</a></li>
          </ul>
        </div>
        <div class=\"col-md-4\">
          <ul class=\"right-icons\">
            <li><a href=\"#\"><i class=\"fa fa-facebook\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-twitter\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-linkedin\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-behance\"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <header>
    <nav class=\"navbar navbar-expand-lg\">
      <div class=\"container\">
        <a class=\"navbar-brand\" href=\"#\">
          <img src=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/back/img/logo.png"), "html", null, true);
        yield "\" alt=\"Logo\" style=\"height: 50px;\">
          <h2 style=\"margin: 0; font-size: 18px; color: #8bc34a;\">RELIF pour l'environnement</h2>
        </a>
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\">
          <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
          <ul class=\"navbar-nav ml-auto\">
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"/\">Home</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">About Us</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"";
        // line 55
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_public");
        yield "\">Nos évènements</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Contenu spécifique à chaque page -->
  <main>
    ";
        // line 65
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 66
        yield "  </main>

  <!-- Footer -->
  <footer>
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-3\">[...]</div>
        <div class=\"col-md-3\">[...]</div>
        <div class=\"col-md-3\">[...]</div>
        <div class=\"col-md-3\">[...]</div>
      </div>
    </div>
  </footer>

  ";
        // line 80
        yield from $this->unwrap()->yieldBlock('js', $context, $blocks);
        // line 88
        yield "</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "RELIF ENVIRONNEMENT";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_css(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "css"));

        // line 9
        yield "    <link rel=\"stylesheet\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("vendor/bootstrap/css/bootstrap.min.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/fontawesome.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/templatemo-finance-business.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/owl.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/flex-slider.css"), "html", null, true);
        yield "\">
  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 65
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 80
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "js"));

        // line 81
        yield "    <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("vendor/jquery/jquery.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 82
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("vendor/bootstrap/js/bootstrap.bundle.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 83
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/custom.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/owl.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/slick.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 86
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/accordions.js"), "html", null, true);
        yield "\"></script>
  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "homepage.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  252 => 86,  248 => 85,  244 => 84,  240 => 83,  236 => 82,  231 => 81,  221 => 80,  205 => 65,  195 => 13,  191 => 12,  187 => 11,  183 => 10,  178 => 9,  168 => 8,  151 => 7,  141 => 88,  139 => 80,  123 => 66,  121 => 65,  108 => 55,  95 => 45,  63 => 15,  61 => 8,  57 => 7,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("
<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <title>{% block title %}RELIF ENVIRONNEMENT{% endblock %}</title>
  {% block css %}
    <link rel=\"stylesheet\" href=\"{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('assets/css/fontawesome.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('assets/css/templatemo-finance-business.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('assets/css/owl.css') }}\">
    <link rel=\"stylesheet\" href=\"{{ asset('assets/css/flex-slider.css') }}\">
  {% endblock %}
</head>

<body>
  <!-- Sub Header -->
  <div class=\"sub-header\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-8\">
          <ul class=\"left-info\">
            <li><a href=\"#\"><i class=\"fa fa-clock-o\"></i>Mon - Fri 09:00-17:00</a></li>
            <li><a href=\"#\"><i class=\"fa fa-phone\"></i>010-020-0340</a></li>
          </ul>
        </div>
        <div class=\"col-md-4\">
          <ul class=\"right-icons\">
            <li><a href=\"#\"><i class=\"fa fa-facebook\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-twitter\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-linkedin\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-behance\"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <header>
    <nav class=\"navbar navbar-expand-lg\">
      <div class=\"container\">
        <a class=\"navbar-brand\" href=\"#\">
          <img src=\"{{ asset('assets/back/img/logo.png') }}\" alt=\"Logo\" style=\"height: 50px;\">
          <h2 style=\"margin: 0; font-size: 18px; color: #8bc34a;\">RELIF pour l'environnement</h2>
        </a>
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\">
          <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
          <ul class=\"navbar-nav ml-auto\">
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"/\">Home</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">About Us</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"{{ path('app_event_public') }}\">Nos évènements</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Contenu spécifique à chaque page -->
  <main>
    {% block body %}{% endblock %}
  </main>

  <!-- Footer -->
  <footer>
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-3\">[...]</div>
        <div class=\"col-md-3\">[...]</div>
        <div class=\"col-md-3\">[...]</div>
        <div class=\"col-md-3\">[...]</div>
      </div>
    </div>
  </footer>

  {% block js %}
    <script src=\"{{ asset('vendor/jquery/jquery.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}\"></script>
    <script src=\"{{ asset('assets/js/custom.js') }}\"></script>
    <script src=\"{{ asset('assets/js/owl.js') }}\"></script>
    <script src=\"{{ asset('assets/js/slick.js') }}\"></script>
    <script src=\"{{ asset('assets/js/accordions.js') }}\"></script>
  {% endblock %}
</body>
</html>
", "homepage.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal\\templates\\homepage.html.twig");
    }
}
