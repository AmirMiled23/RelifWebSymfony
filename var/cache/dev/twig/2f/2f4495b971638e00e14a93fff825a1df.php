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
        yield "<!DOCTYPE html>
<html lang=\"en\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

  <title>";
        // line 8
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
  ";
        // line 9
        yield from $this->unwrap()->yieldBlock('css', $context, $blocks);
        // line 18
        yield "</head>

<body>
  ";
        // line 21
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 355
        yield " ";
        yield from $this->unwrap()->yieldBlock('js', $context, $blocks);
        // line 376
        yield "  
</body>

</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 8
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

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_css(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "css"));

        // line 10
        yield "  <!-- CSS Files -->
  <link rel=\"stylesheet\" href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("vendor/bootstrap/css/bootstrap.min.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/fontawesome.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/templatemo-finance-business.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/owl.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/flex-slider.css"), "html", null, true);
        yield "\">

  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 22
        yield "  
  <!-- Sub Header -->
  <div class=\"sub-header\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-8 col-xs-12\">
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
  <header class=\"\">
      <nav class=\"navbar navbar-expand-lg\">
        <div class=\"container\">
          <a class=\"navbar-brand\" href=\"#\" style=\"display: flex; align-items: center; gap: 10px;\">
  <img src=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/back/img/logo.png"), "html", null, true);
        yield "\" alt=\"Logo\" style=\"height: 50px;\">
  <h2 style=\"margin: 0; font-size: 18px; color: #8bc34a;\">RELIF pour l'environnement</h2>
</a>

          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
          </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
            <ul class=\"navbar-nav ml-auto\">
              <li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"#top\">Home
                  <span class=\"sr-only\">(current)</span>
                </a>
              </li>
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"about.html\">About Us</a>
              </li>  
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"services.html\">Nos evenements</a>
              </li>                          
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"contact.html\">Contact Us</a>
              </li>
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"one-page.html\">One Page</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>


  <!-- Main Banner -->
  <div class=\"main-banner header-text\" id=\"top\">
    <div class=\"Modern-Slider\">
      <!-- Slide Items -->
      <div class=\"item item-1\">
        <div class=\"img-fill\">
          
            <h6>Welcome to Finance Business</h6>
            <h4>We help you<br>Grow your business</h4>
            <a href=\"#\" class=\"filled-button\">Contact Us</a>
          
        </div>
      </div>
      <!-- Add more slides here -->
    </div>
  </div>

<!-- SERVICES SECTION -->
<div class=\"services\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"section-heading\">
          <h2>Financial <em>Services</em></h2>
          <span>Aliquam id urna imperdiet libero mollis hendrerit</span>
        </div>
      </div>

      <div class=\"col-md-4\">
        <div class=\"service-item\">
          <img src=\"assets/images/service_01.jpg\" alt=\"\">
          <div class=\"down-content\">
            <h4>Digital Currency</h4>
            <p>Sed tincidunt dictum lobortis. Aenean tempus diam vel augue luctus dignissim. Nunc ornare leo tortor.</p>
            <a href=\"\" class=\"filled-button\">Read More</a>
          </div>
        </div>
      </div>

      <div class=\"col-md-4\">
        <div class=\"service-item\">
          <img src=\"assets/images/service_02.jpg\" alt=\"\">
          <div class=\"down-content\">
            <h4>Market Analysis</h4>
            <p>Sed tincidunt dictum lobortis. Aenean tempus diam vel augue luctus dignissim. Nunc ornare leo tortor.</p>
            <a href=\"\" class=\"filled-button\">Read More</a>
          </div>
        </div>
      </div>

      <div class=\"col-md-4\">
        <div class=\"service-item\">
          <img src=\"assets/images/service_03.jpg\" alt=\"\">
          <div class=\"down-content\">
            <h4>Historical Data</h4>
            <p>Sed tincidunt dictum lobortis. Aenean tempus diam vel augue luctus dignissim. Nunc ornare leo tortor.</p>
            <a href=\"\" class=\"filled-button\">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FUN FACTS SECTION -->
<div class=\"fun-facts\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-6\">
        <div class=\"left-content\">
          <span>Lorem ipsum dolor sit amet</span>
          <h2>Our solutions for your <em>business growth</em></h2>
          <p>
            Pellentesque ultrices at turpis in vestibulum. Aenean pretium elit nec congue elementum. Nulla luctus laoreet porta. Maecenas at nisi tempus, porta metus vitae, faucibus augue.
            <br><br>
            Fusce et venenatis ex. Quisque varius, velit quis dictum sagittis, odio velit molestie nunc, ut posuere ante tortor ut neque.
          </p>
          <a href=\"\" class=\"filled-button\">Read More</a>
        </div>
      </div>

      <div class=\"col-md-6 align-self-center\">
        <div class=\"row\">
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">945</div>
              <div class=\"count-title\">Work Hours</div>
            </div>
          </div>
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">1280</div>
              <div class=\"count-title\">Great Reviews</div>
            </div>
          </div>
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">578</div>
              <div class=\"count-title\">Projects Done</div>
            </div>
          </div>
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">26</div>
              <div class=\"count-title\">Awards Won</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- More Info Section -->
  <div class=\"more-info\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"more-info-content\">
            <div class=\"row\">
              <div class=\"col-md-6\">
                <div class=\"left-image\">
                  <img src=\"";
        // line 205
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/images/more-info.jpg"), "html", null, true);
        yield "\" alt=\"\">
                </div>
              </div>
              <div class=\"col-md-6 align-self-center\">
                <div class=\"right-content\">
                  <span>Who we are</span>
                  <h2>Get to know about <em>our company</em></h2>
                  <p>Curabitur pulvinar sem a leo tempus facilisis...</p>
                  <a href=\"#\" class=\"filled-button\">Read More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Testimonials -->
  <div class=\"testimonials\">
    <div class=\"container\">
      <div class=\"section-heading\">
        <h2>What they say <em>about us</em></h2>
        <span>testimonials from our greatest clients</span>
      </div>
      <div class=\"owl-testimonials owl-carousel\">
        <div class=\"testimonial-item\">
          <div class=\"inner-content\">
            <h4>George Walker</h4>
            <span>Chief Financial Analyst</span>
            <p>\"Lorem ipsum dolor sit amet...\"</p>
          </div>
          <img src=\"https://via.placeholder.com/60x60\" alt=\"\">
        </div>
        <!-- Add more testimonials here -->
      </div>
    </div>
  </div>

  <!-- Callback Form -->
  <div class=\"callback-form\" id=\"contact\">
    <div class=\"container\">
      <div class=\"section-heading\">
        <h2>Request a <em>call back</em></h2>
        <span>Etiam suscipit ante a odio consequat</span>
      </div>
      <div class=\"contact-form\">
        <form id=\"contact\" action=\"\" method=\"post\">
          <div class=\"row\">
            <div class=\"col-lg-4\">
              <fieldset>
                <input name=\"name\" type=\"text\" class=\"form-control\" placeholder=\"Full Name\" required=\"\">
              </fieldset>
            </div>
            <div class=\"col-lg-4\">
              <fieldset>
                <input name=\"email\" type=\"email\" class=\"form-control\" placeholder=\"E-Mail Address\" required=\"\">
              </fieldset>
            </div>
            <div class=\"col-lg-4\">
              <fieldset>
                <input name=\"subject\" type=\"text\" class=\"form-control\" placeholder=\"Subject\" required=\"\">
              </fieldset>
            </div>
            <div class=\"col-lg-12\">
              <fieldset>
                <textarea name=\"message\" rows=\"6\" class=\"form-control\" placeholder=\"Your Message\" required=\"\"></textarea>
              </fieldset>
            </div>
            <div class=\"col-lg-12\">
              <fieldset>
                <button type=\"submit\" class=\"border-button\">Send Message</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Partners -->
  <div class=\"partners\">
    <div class=\"container\">
      <div class=\"owl-partners owl-carousel\">
        <div class=\"partner-item\">
          <img src=\"";
        // line 290
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/images/client-01.png"), "html", null, true);
        yield "\" title=\"1\" alt=\"1\">
        </div>
        <!-- Add more partners here -->
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-3 footer-item\">
          <h4>Finance Business</h4>
          <p>Vivamus tellus mi. Nulla ne cursus elit...</p>
          <ul class=\"social-icons\">
            <li><a href=\"#\"><i class=\"fa fa-facebook\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-twitter\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-linkedin\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-behance\"></i></a></li>
          </ul>
        </div>
        <div class=\"col-md-3 footer-item\">
          <h4>Useful Links</h4>
          <ul class=\"menu-list\">
            <li><a href=\"#\">Vivamus ut tellus mi</a></li>
          </ul>
        </div>
        <div class=\"col-md-3 footer-item\">
          <h4>Additional Pages</h4>
          <ul class=\"menu-list\">
            <li><a href=\"#\">About Us</a></li>
          </ul>
        </div>
        <div class=\"col-md-3 footer-item last-item\">
          <h4>Contact Us</h4>
          <form id=\"contact-footer\" action=\"\" method=\"post\">
            <fieldset>
              <input name=\"name\" type=\"text\" class=\"form-control\" placeholder=\"Full Name\" required=\"\">
            </fieldset>
            <fieldset>
              <input name=\"email\" type=\"email\" class=\"form-control\" placeholder=\"E-Mail Address\" required=\"\">
            </fieldset>
            <fieldset>
              <textarea name=\"message\" rows=\"6\" class=\"form-control\" placeholder=\"Your Message\" required=\"\"></textarea>
            </fieldset>
            <fieldset>
              <button type=\"submit\" class=\"filled-button\">Send Message</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </footer>

  <div class=\"sub-footer\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <p>&copy; 2020 Financial Business Co., Ltd. - Design: <a href=\"https://templatemo.com\">TemplateMo</a></p>
        </div>
      </div>
    </div>
  </div>

  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 355
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "js"));

        // line 356
        yield "  <!-- JS Files -->
  <script src=\"";
        // line 357
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("vendor/jquery/jquery.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 358
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("vendor/bootstrap/js/bootstrap.bundle.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 359
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/custom.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 360
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/owl.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 361
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/jquery.singlePageNav.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 362
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/slick.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 363
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/accordions.js"), "html", null, true);
        yield "\"></script>

  <script>
    const cleared = [0, 0, 0];
    function clearField(t) {
      if (!cleared[t.id]) {
        cleared[t.id] = 1;
        t.value = '';
        t.style.color = '#fff';
      }
    }
  </script>
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
    public function getDebugInfo(): array
    {
        return array (  539 => 363,  535 => 362,  531 => 361,  527 => 360,  523 => 359,  519 => 358,  515 => 357,  512 => 356,  502 => 355,  429 => 290,  341 => 205,  183 => 50,  153 => 22,  143 => 21,  132 => 15,  128 => 14,  124 => 13,  120 => 12,  116 => 11,  113 => 10,  103 => 9,  86 => 8,  74 => 376,  71 => 355,  69 => 21,  64 => 18,  62 => 9,  58 => 8,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

  <title>{% block title %}RELIF ENVIRONNEMENT{% endblock %}</title>
  {% block css %}
  <!-- CSS Files -->
  <link rel=\"stylesheet\" href=\"{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/fontawesome.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/templatemo-finance-business.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/owl.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/flex-slider.css') }}\">

  {% endblock %}
</head>

<body>
  {% block body %}
  
  <!-- Sub Header -->
  <div class=\"sub-header\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-8 col-xs-12\">
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
  <header class=\"\">
      <nav class=\"navbar navbar-expand-lg\">
        <div class=\"container\">
          <a class=\"navbar-brand\" href=\"#\" style=\"display: flex; align-items: center; gap: 10px;\">
  <img src=\"{{ asset('assets/back/img/logo.png') }}\" alt=\"Logo\" style=\"height: 50px;\">
  <h2 style=\"margin: 0; font-size: 18px; color: #8bc34a;\">RELIF pour l'environnement</h2>
</a>

          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
          </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
            <ul class=\"navbar-nav ml-auto\">
              <li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"#top\">Home
                  <span class=\"sr-only\">(current)</span>
                </a>
              </li>
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"about.html\">About Us</a>
              </li>  
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"services.html\">Nos evenements</a>
              </li>                          
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"contact.html\">Contact Us</a>
              </li>
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"one-page.html\">One Page</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>


  <!-- Main Banner -->
  <div class=\"main-banner header-text\" id=\"top\">
    <div class=\"Modern-Slider\">
      <!-- Slide Items -->
      <div class=\"item item-1\">
        <div class=\"img-fill\">
          
            <h6>Welcome to Finance Business</h6>
            <h4>We help you<br>Grow your business</h4>
            <a href=\"#\" class=\"filled-button\">Contact Us</a>
          
        </div>
      </div>
      <!-- Add more slides here -->
    </div>
  </div>

<!-- SERVICES SECTION -->
<div class=\"services\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12\">
        <div class=\"section-heading\">
          <h2>Financial <em>Services</em></h2>
          <span>Aliquam id urna imperdiet libero mollis hendrerit</span>
        </div>
      </div>

      <div class=\"col-md-4\">
        <div class=\"service-item\">
          <img src=\"assets/images/service_01.jpg\" alt=\"\">
          <div class=\"down-content\">
            <h4>Digital Currency</h4>
            <p>Sed tincidunt dictum lobortis. Aenean tempus diam vel augue luctus dignissim. Nunc ornare leo tortor.</p>
            <a href=\"\" class=\"filled-button\">Read More</a>
          </div>
        </div>
      </div>

      <div class=\"col-md-4\">
        <div class=\"service-item\">
          <img src=\"assets/images/service_02.jpg\" alt=\"\">
          <div class=\"down-content\">
            <h4>Market Analysis</h4>
            <p>Sed tincidunt dictum lobortis. Aenean tempus diam vel augue luctus dignissim. Nunc ornare leo tortor.</p>
            <a href=\"\" class=\"filled-button\">Read More</a>
          </div>
        </div>
      </div>

      <div class=\"col-md-4\">
        <div class=\"service-item\">
          <img src=\"assets/images/service_03.jpg\" alt=\"\">
          <div class=\"down-content\">
            <h4>Historical Data</h4>
            <p>Sed tincidunt dictum lobortis. Aenean tempus diam vel augue luctus dignissim. Nunc ornare leo tortor.</p>
            <a href=\"\" class=\"filled-button\">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FUN FACTS SECTION -->
<div class=\"fun-facts\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-6\">
        <div class=\"left-content\">
          <span>Lorem ipsum dolor sit amet</span>
          <h2>Our solutions for your <em>business growth</em></h2>
          <p>
            Pellentesque ultrices at turpis in vestibulum. Aenean pretium elit nec congue elementum. Nulla luctus laoreet porta. Maecenas at nisi tempus, porta metus vitae, faucibus augue.
            <br><br>
            Fusce et venenatis ex. Quisque varius, velit quis dictum sagittis, odio velit molestie nunc, ut posuere ante tortor ut neque.
          </p>
          <a href=\"\" class=\"filled-button\">Read More</a>
        </div>
      </div>

      <div class=\"col-md-6 align-self-center\">
        <div class=\"row\">
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">945</div>
              <div class=\"count-title\">Work Hours</div>
            </div>
          </div>
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">1280</div>
              <div class=\"count-title\">Great Reviews</div>
            </div>
          </div>
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">578</div>
              <div class=\"count-title\">Projects Done</div>
            </div>
          </div>
          <div class=\"col-md-6\">
            <div class=\"count-area-content\">
              <div class=\"count-digit\">26</div>
              <div class=\"count-title\">Awards Won</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- More Info Section -->
  <div class=\"more-info\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"more-info-content\">
            <div class=\"row\">
              <div class=\"col-md-6\">
                <div class=\"left-image\">
                  <img src=\"{{ asset('assets/images/more-info.jpg') }}\" alt=\"\">
                </div>
              </div>
              <div class=\"col-md-6 align-self-center\">
                <div class=\"right-content\">
                  <span>Who we are</span>
                  <h2>Get to know about <em>our company</em></h2>
                  <p>Curabitur pulvinar sem a leo tempus facilisis...</p>
                  <a href=\"#\" class=\"filled-button\">Read More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Testimonials -->
  <div class=\"testimonials\">
    <div class=\"container\">
      <div class=\"section-heading\">
        <h2>What they say <em>about us</em></h2>
        <span>testimonials from our greatest clients</span>
      </div>
      <div class=\"owl-testimonials owl-carousel\">
        <div class=\"testimonial-item\">
          <div class=\"inner-content\">
            <h4>George Walker</h4>
            <span>Chief Financial Analyst</span>
            <p>\"Lorem ipsum dolor sit amet...\"</p>
          </div>
          <img src=\"https://via.placeholder.com/60x60\" alt=\"\">
        </div>
        <!-- Add more testimonials here -->
      </div>
    </div>
  </div>

  <!-- Callback Form -->
  <div class=\"callback-form\" id=\"contact\">
    <div class=\"container\">
      <div class=\"section-heading\">
        <h2>Request a <em>call back</em></h2>
        <span>Etiam suscipit ante a odio consequat</span>
      </div>
      <div class=\"contact-form\">
        <form id=\"contact\" action=\"\" method=\"post\">
          <div class=\"row\">
            <div class=\"col-lg-4\">
              <fieldset>
                <input name=\"name\" type=\"text\" class=\"form-control\" placeholder=\"Full Name\" required=\"\">
              </fieldset>
            </div>
            <div class=\"col-lg-4\">
              <fieldset>
                <input name=\"email\" type=\"email\" class=\"form-control\" placeholder=\"E-Mail Address\" required=\"\">
              </fieldset>
            </div>
            <div class=\"col-lg-4\">
              <fieldset>
                <input name=\"subject\" type=\"text\" class=\"form-control\" placeholder=\"Subject\" required=\"\">
              </fieldset>
            </div>
            <div class=\"col-lg-12\">
              <fieldset>
                <textarea name=\"message\" rows=\"6\" class=\"form-control\" placeholder=\"Your Message\" required=\"\"></textarea>
              </fieldset>
            </div>
            <div class=\"col-lg-12\">
              <fieldset>
                <button type=\"submit\" class=\"border-button\">Send Message</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Partners -->
  <div class=\"partners\">
    <div class=\"container\">
      <div class=\"owl-partners owl-carousel\">
        <div class=\"partner-item\">
          <img src=\"{{ asset('assets/images/client-01.png') }}\" title=\"1\" alt=\"1\">
        </div>
        <!-- Add more partners here -->
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-3 footer-item\">
          <h4>Finance Business</h4>
          <p>Vivamus tellus mi. Nulla ne cursus elit...</p>
          <ul class=\"social-icons\">
            <li><a href=\"#\"><i class=\"fa fa-facebook\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-twitter\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-linkedin\"></i></a></li>
            <li><a href=\"#\"><i class=\"fa fa-behance\"></i></a></li>
          </ul>
        </div>
        <div class=\"col-md-3 footer-item\">
          <h4>Useful Links</h4>
          <ul class=\"menu-list\">
            <li><a href=\"#\">Vivamus ut tellus mi</a></li>
          </ul>
        </div>
        <div class=\"col-md-3 footer-item\">
          <h4>Additional Pages</h4>
          <ul class=\"menu-list\">
            <li><a href=\"#\">About Us</a></li>
          </ul>
        </div>
        <div class=\"col-md-3 footer-item last-item\">
          <h4>Contact Us</h4>
          <form id=\"contact-footer\" action=\"\" method=\"post\">
            <fieldset>
              <input name=\"name\" type=\"text\" class=\"form-control\" placeholder=\"Full Name\" required=\"\">
            </fieldset>
            <fieldset>
              <input name=\"email\" type=\"email\" class=\"form-control\" placeholder=\"E-Mail Address\" required=\"\">
            </fieldset>
            <fieldset>
              <textarea name=\"message\" rows=\"6\" class=\"form-control\" placeholder=\"Your Message\" required=\"\"></textarea>
            </fieldset>
            <fieldset>
              <button type=\"submit\" class=\"filled-button\">Send Message</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </footer>

  <div class=\"sub-footer\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-12\">
          <p>&copy; 2020 Financial Business Co., Ltd. - Design: <a href=\"https://templatemo.com\">TemplateMo</a></p>
        </div>
      </div>
    </div>
  </div>

  {% endblock %}
 {% block js %}
  <!-- JS Files -->
  <script src=\"{{ asset('vendor/jquery/jquery.min.js') }}\"></script>
  <script src=\"{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/custom.js') }}\"></script>
  <script src=\"{{ asset('assets/js/owl.js') }}\"></script>
  <script src=\"{{ asset('assets/js/jquery.singlePageNav.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/slick.js') }}\"></script>
  <script src=\"{{ asset('assets/js/accordions.js') }}\"></script>

  <script>
    const cleared = [0, 0, 0];
    function clearField(t) {
      if (!cleared[t.id]) {
        cleared[t.id] = 1;
        t.value = '';
        t.style.color = '#fff';
      }
    }
  </script>
 {% endblock %}
  
</body>

</html>
", "homepage.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal\\templates\\homepage.html.twig");
    }
}
