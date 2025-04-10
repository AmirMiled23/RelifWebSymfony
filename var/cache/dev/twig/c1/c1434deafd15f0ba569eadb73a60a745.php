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

/* AjoutCat.html.twig */
class __TwigTemplate_91a6012a6c1c1dc75fdd9782398b72f0 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 2
        return "backoff.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "AjoutCat.html.twig"));

        $this->parent = $this->loadTemplate("backoff.html.twig", "AjoutCat.html.twig", 2);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Ajouter une Catégorie";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 7
        yield "<div style=\"margin-top: 70px;\">
    <div class=\"container mt-5\">
        <h1>Ajouter une Catégorie</h1>
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 10, $this->source); })()), "flashes", [], "any", false, false, false, 10));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 11
            yield "          ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 12
                yield "             <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "\">
                ";
                // line 13
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
             </div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        yield "

        <form method=\"post\" enctype=\"multipart/form-data\" action=\"";
        // line 19
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("categorie_ajout");
        yield "\">
            <div class=\"mb-3\">
                <label for=\"nom\" class=\"form-label\">Nom</label>
                <input type=\"text\" id=\"nom\" name=\"nom\" class=\"form-control\" placeholder=\"Entrez le nom\">
            </div>
            
            <div class=\"mb-3\">
                <label for=\"description\" class=\"form-label\">Description</label>
                <textarea id=\"description\" name=\"description\" class=\"form-control\" placeholder=\"Entrez la description\"></textarea>
            </div>

            <div class=\"mb-3\">
                <label for=\"image\" class=\"form-label\">Image</label>
                <input type=\"file\" id=\"image\" name=\"image\" class=\"form-control\">
            </div>

            <button type=\"submit\" class=\"btn btn-primary\">Ajouter Catégorie</button>
        </form>
    </div>
</div/    
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "AjoutCat.html.twig";
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
        return array (  123 => 19,  119 => 17,  113 => 16,  104 => 13,  99 => 12,  94 => 11,  90 => 10,  85 => 7,  75 => 6,  58 => 4,  41 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/AjoutCat.html.twig #}
{% extends 'backoff.html.twig' %}

{% block title %}Ajouter une Catégorie{% endblock %}

{% block body %}
<div style=\"margin-top: 70px;\">
    <div class=\"container mt-5\">
        <h1>Ajouter une Catégorie</h1>
        {% for label, messages in app.flashes %}
          {% for message in messages %}
             <div class=\"alert alert-{{ label }}\">
                {{ message }}
             </div>
          {% endfor %}
        {% endfor %}


        <form method=\"post\" enctype=\"multipart/form-data\" action=\"{{ path('categorie_ajout' )}}\">
            <div class=\"mb-3\">
                <label for=\"nom\" class=\"form-label\">Nom</label>
                <input type=\"text\" id=\"nom\" name=\"nom\" class=\"form-control\" placeholder=\"Entrez le nom\">
            </div>
            
            <div class=\"mb-3\">
                <label for=\"description\" class=\"form-label\">Description</label>
                <textarea id=\"description\" name=\"description\" class=\"form-control\" placeholder=\"Entrez la description\"></textarea>
            </div>

            <div class=\"mb-3\">
                <label for=\"image\" class=\"form-label\">Image</label>
                <input type=\"file\" id=\"image\" name=\"image\" class=\"form-control\">
            </div>

            <button type=\"submit\" class=\"btn btn-primary\">Ajouter Catégorie</button>
        </form>
    </div>
</div/    
{% endblock %}
", "AjoutCat.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\piNFnlCOP\\Pi\\Pi\\templates\\AjoutCat.html.twig");
    }
}
